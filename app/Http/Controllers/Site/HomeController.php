<?php

namespace App\Http\Controllers\Site;

use App\Models\Banner;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $features = Feature::latest()->get();
        $products = Product::where('is_active', 1)->take(6)->get();
        $categories = Category::orderBy('sort')->get();
        $banners = Banner::latest()->get();
        $sliders = Slider::latest()->get();

        return view('site.home', compact('features', 'products', 'categories', 'banners', 'sliders'));
    }

    public function lang($lang)
    {

        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function productFilter(Request $request)
    {
        $request->validate([
            'amount' => 'required|min:10'
        ], [
            'amount.required' => 'هذا الحقل مطلوب',
            'amount.min' => 'يجب ان يكون الحد الادنى 10'
        ]);
        $array = ['most-sale' , 'new' , 'all'];
        if (!in_array($request->filter , $array)) {
            return redirect()->route('site.home');
        }

        switch ($request->filter) {
            case 'new':
                $products = Product::where('is_active', 1)
                    ->orderBy('id', 'desc')
                    ->take(6)
                    ->get();
                break;

            case 'most-sale':
                $products = OrderItems::with(['products', 'order'])
                    ->whereHas('order', function ($query) {
                        $query->where('status', 'completed');
                    })
                    ->select('product_id', DB::raw('SUM(quantity) as count'))
                    ->groupBy('product_id')
                    ->orderBy('count', 'desc')
                    ->get()
                    ->map(function ($item) {
                        return $item->products;
                    });
                break;

            case 'all':
            default:
                $products = Product::where('is_active', 1)
                    ->take(6)
                    ->get();
                break;
        }

     //   return $products;

          return view('site.homefilter', compact('products'))->render();


    }
}
