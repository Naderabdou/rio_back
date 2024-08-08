<?php

namespace App\Http\Controllers\Site;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    public function index()
    {
        $products = Product::when(Request()->search, function ($query) {
            $query->where(function ($subQuery) {
                $searchTerm = Request()->search;
                $subQuery->where('name_ar', 'like', '%' . $searchTerm . '%')
                    ->orWhere('name_en', 'like', '%' . $searchTerm . '%');
            });
        })->where('is_active', 1)->where('has_offer', 1)->latest()->get();


        $categories = Category::withCount(['products' => function ($query) {
            $query->where('is_active', 1)->where('has_offer', 1);
        }])->orderBy('sort')->get();

        $brands = Brand::latest()->get();
        return view('site.products.offer', compact('products', 'categories', 'brands'));
    }
    public function product_category($id)
    {
        $products = Product::where('category_id', $id)->where('is_active', 1)->latest()->get();
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('is_active', 1);
        }])->orderBy('sort')->get();
        $brands = Brand::latest()->get();
        return view('site.products.index', compact('products', 'categories', 'brands'));
    }

    // public function pagintions(){

    //     $products = Product::where('is_active', 1)->latest()->get();
    //     return response()->json($products);
    // }



    public function filter(Request $request)
    {

        $category = $request->category;

        // $brand = $request->brand;
        $min_num = (int) $request->min_num;
        $max_num = (int) $request->max_num;
        $arrange = $request->arrange;
        $products = Product::when($category, function ($query) use ($category) {
            return $query->where('category_id', $category);
        })->when($min_num !== null && $max_num !== null, function ($query) use ($min_num, $max_num) {
            return $query->where(function ($query) use ($min_num, $max_num) {
                if (auth()->check() && auth()->user()->hasRole('merchant')) {
                    $query->whereBetween('list_price', [$min_num, $max_num]);
                } else {
                    $query->whereNotNull('price_after_discount')
                        ->whereBetween('price_after_discount', [$min_num, $max_num])
                        ->orWhere(function ($query) use ($min_num, $max_num) {
                            $query->whereNull('price_after_discount')
                                ->whereBetween('price', [$min_num, $max_num]);
                        });
                }
            });
        })
            ->when($arrange == 'low_high' || $arrange == 'high_low', function ($query) use ($arrange) {
                $direction = $arrange == 'low_high' ? 'ASC' : 'DESC';

                if (auth()->check() && auth()->user()->hasRole('merchant')) {
                    return $query->orderByRaw("CAST(list_price AS UNSIGNED) $direction");
                } else {
                    return $query->orderByRaw("CASE WHEN price_after_discount IS NOT NULL THEN CAST(price_after_discount AS UNSIGNED) ELSE CAST(price AS UNSIGNED) END $direction");
                }
            })->when($arrange == 'latest', function ($query) {
                return $query->orderBy('id', 'desc');
            })->when($arrange == 'all', function ($query) {
                return $query->orderBy('id', 'asc');
            })->where('is_active', 1)->where('has_offer', 1)->latest()->get();
        return view('site.products.filter', compact('products', 'arrange'))->render();
    }
}
