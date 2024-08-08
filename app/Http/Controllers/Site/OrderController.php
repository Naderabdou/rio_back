<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = auth()->user()->orders()->where('status', '!=', 'completed')->latest()->get();

        return view('site.profile.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = auth()->user()->orders()->where('id', $id)->first();

        return view('site.profile.order_details', compact('order'));
    }

    public function filter(Request $request)
    {
        if ($request->filter == 'pending')
            $orders = auth()->user()->orders()->where('status', '!=', 'completed')->latest()->get();
        else {

            $orders = auth()->user()->orders()->where('status', 'completed')->  latest()->get();
        }



        return view('site.components.orderFilter', compact('orders'))->render();
    }

    public function notifiy(){

        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function notifiyRead($id, $order_id){

        $user = auth()->user(); // Get the currently authenticated user
        $user->unreadNotifications->where('id', $id)->first()->markAsRead() ;

        return redirect()->route('site.orders.show', $order_id);


    }


}
