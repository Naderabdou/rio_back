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


    public function changeStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $status]);
        switch ($status) {
            case 'completed':
                $order->update(['completed_at' => now()]);
                break;
            case 'driving':
                $order->update(['driving_at' => now()]);
                break;
            case 'processing':
                $order->update(['processing_at' => now()]);
                break;
            case 'shipped':
                $order->update(['shipped_at' => now()]);
                break;
            case 'declined':
                $order->update(['canceled_at' => now()]);
                break;
        }
        return redirect()->back()->with('success', 'تم تغيير حالة الطلب بنجاح');
    }


    public function destroy($id)
    {
        return redirect()->route('admin.orders.index');
    }
}
