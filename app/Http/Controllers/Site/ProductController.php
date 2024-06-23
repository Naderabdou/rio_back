<?php

namespace App\Http\Controllers\Site;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {


        $products = Product::when(Request()->search, function ($query) {

            $query->where('name_ar', 'like', '%' . Request()->search . '%')->orWhere('name_en', 'like', '%' . Request()->search . '%');
        })->paginate(9);
        $categories = Category::withCount('products')->latest()->get();
        $brands = Brand::latest()->get();
        return view('site.products.index', compact('products', 'categories', 'brands'));
    }

    public function show($id)
    {
        $reviews = Product::find($id)->reviews;
        $product = Product::findOrFail($id);
        $productsRalated = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();
        return view('site.products.show', compact('product', 'productsRalated', 'reviews'));
    }

    public function filter(Request $request)
    {

        $category = $request->category;
        $brand = $request->brand;
        $min_num = (int) $request->min_num;
        $max_num = (int) $request->max_num;
        $arrange = $request->arrange;

        $products = Product::when($category, function ($query) use ($category) {
            return $query->where('category_id', $category);
        })->when($brand, function ($query) use ($brand) {
            return $query->whereIn('brand_id', $brand);
        })->whereBetween('price', [$min_num, $max_num])
        ->when($arrange == 'low_high', function ($query) {
            return $query->orderBy('price', 'asc');
        })->when($arrange == 'high_low', function ($query) {
            return $query->orderBy('price', 'desc');
        })->when($arrange == 'latest', function ($query) {
            return $query->orderBy('id', 'desc');
        })->when($arrange == 'all', function ($query) {
            return $query->orderBy('id', 'asc');
        })->get();
        return view('site.products.filter', compact('products' , 'arrange'))->render();
    }

    // public function arrange(Request $request)
    // {
    //     if ($request->arrange == 'all') {
    //         $products = Product::get();
    //     } else {
    //         $products = Product::orderBy('id', 'desc')->get();
    //     }
    //     $arrange = $request->arrange;
    //     return view('site.products.filter', compact('products' , 'arrange' ))->render();
    // }
}
