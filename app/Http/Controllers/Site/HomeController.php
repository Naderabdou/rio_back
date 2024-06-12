<?php

namespace App\Http\Controllers\Site;

use App\Models\Banner;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $features = Feature::latest()->get();
        $products = Product::where('is_active', 1)->latest()->get();
        $categories = Category::latest()->get();
        $banners = Banner::latest()->get();

        return view('site.home', compact('features', 'products', 'categories', 'banners'));
    }

    public function lang($lang)
    {

        session()->put('lang', $lang);
        return redirect()->back();
    }
}
