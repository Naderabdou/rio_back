<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('type', 'order')->latest()->get();
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show($id)
    {
       $order = Order::findOrFail($id);
        return view('dashboard.orders.show', compact('order'));
    }


    public function destroy($id)
    {
        return redirect()->route('admin.orders.index');
    }

}
