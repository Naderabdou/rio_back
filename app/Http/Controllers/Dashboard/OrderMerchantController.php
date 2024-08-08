<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ChengeStatusNotifiction;

class OrderMerchantController extends Controller
{
    public function index()
    {
        $orders = Order::where('type', 'order')->where('type_order', 'merchant')->latest()->get();


        return view('dashboard.ordersMerchant.index', compact('orders'));
    }

    public function show($id)
    {

        $order = Order::where('type_order', 'merchant')->findOrFail($id);

        return view('dashboard.ordersMerchant.show', compact('order'));
    }

    public function changeStatus($id, $status)
    {
        $order = Order::where('type_order', 'merchant')->findOrFail($id);

        // $order->update(['status' => $status]);
        switch ($status) {

            case 'pocessing':
                if ($order->status == 'completed') {
                    return redirect()->back()->with('error', 'لا يمكن تغيير حالة الطلب لان الطلب تم توصيله');
                }
                $order->update(['processing_at' =>  now(), 'status' => 'pocessing']);
                break;
            case 'shipped':
                if ($order->status == 'pocessing') {
                    $order->update(['shipped_at' =>  now(), 'status' => 'shipped']);
                } else {
                    return redirect()->back()->with('error', 'لا يمكن تغيير حالة الطلب الى تم الشحن الا بعد تغيير حالة الطلب الى تحت التجهيز');
                }
                // $order->update(['shipped_at' =>  now()]);
                break;
            case 'driving':
                if ($order->status == 'shipped') {
                    $order->update(['driving_at' =>  now(), 'status' => 'driving']);
                } else {
                    return redirect()->back()->with('error', 'لا يمكن تغيير حالة الطلب الى الطلب مع السائق الا بعد تغيير حالة الطلب الى تم الشحن');
                }
                // $order->update(['driving_at' =>  now()]);
                break;
            case 'completed':
                if ($order->status == 'driving') {
                    $order->update(['completed_at' =>  now(), 'status' => 'completed']);
                } else {
                    return redirect()->back()->with('error', 'لا يمكن تغيير حالة الطلب الى تم التوصيل الا بعد تغيير حالة الطلب الى الطلب مع السائق');
                }
                // $order->update(['completed_at' => now()]);
                $order->update(['completed_at' => now()]);
                break;



            case 'declined':
                $order->update(['canceled_at' =>  now()]);
                break;
        }
        $data = [
            'title_ar' => 'تم تغيير حالة الطلب',
            'title_en' => 'Order status has been changed',
            'body_ar' => 'تم تغيير حالة الطلب الى ' . transWord($status),
            'body_en' => 'Order status has been changed to ' . transWord($status),
            'order_id' => $order->id,
            'order_number' => $order->order_number,
        ];


        $order->user->notify(new ChengeStatusNotifiction($data));

        return redirect()->back()->with('success', 'تم تغيير حالة الطلب بنجاح');
    }

    public function update(Request $request, $id)
    {

        $order = Order::where('type_order', 'merchant')->findOrFail($id);
        $order->update(['discount' => $request->discount ?? 0]);

        return redirect()->route('admin.order-merchants.index')->with('success', 'تم اضافة الخصم بنجاح');
    }
}
