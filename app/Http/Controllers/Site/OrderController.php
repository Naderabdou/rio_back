<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = auth()->user()->orders()->where('status', '!=', 'completed')->get();
        
        return view('site.profile.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = auth()->user()->orders()->where('id', $id)->first();

        return view('site.profile.order_details', compact('order'));
    }

    public function filter(Request $request)
    {

        $orders = auth()->user()->orders()->where('status', $request->filter)->get();


        return view('site.components.orderFilter', compact('orders'))->render();
    }
}
