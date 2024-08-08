<?php

namespace App\Http\Controllers\Dashboard;

use DateTime;
use DateTimeZone;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ChengeStatusNotifiction;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('type', 'order')->where('type_order', 'user')->latest()->get();
        return view('dashboard.orders.index', compact('orders'));
    }
    public function notifiy()
    {

        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return redirect()->route('admin.orders.index');
    }

    public function show($id)
    {

        $order = Order::where('type_order', 'user')->findOrFail($id);

        return view('dashboard.orders.show', compact('order'));
    }


    public function changeStatus($id, $status)
    {
        $order = Order::where('type_order', 'user')->findOrFail($id);

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

    public function notifiyRead($id, $order_id)
    {

        $user = auth()->user(); // Get the currently authenticated user
        $notifications = $user->unreadNotifications->where('id', $id)->first();
        if ($notifications->data['type_order'] == 'user') {

            $notifications->markAsRead();
            return redirect()->route('admin.orders.show', $order_id);
        }
        $notifications->markAsRead();
        return redirect()->route('admin.order-merchants.show', $order_id);
    }

    public function destroy($id)
    {
        return redirect()->route('admin.orders.index');
    }
}
