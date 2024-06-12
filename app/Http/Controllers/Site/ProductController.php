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
        $product = Product::findOrFail($id);
        $reviews = $product->reviews()->paginate(10);

        $productsRalated = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();
        return view('site.products.show', compact('product', 'productsRalated', 'reviews'));
    }
}
