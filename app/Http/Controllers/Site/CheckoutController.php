<?php

namespace App\Http\Controllers\site;

use DateTime;
use DateTimeZone;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Traits\PaymentsMethod;
use App\Services\PaymobService;
use App\Http\Controllers\Controller;
use App\Notifications\OrdersNotifiction;

class CheckoutController extends Controller
{
    use PaymentsMethod;
    protected $paymobService;

    public function __construct(PaymobService $paymobService)
    {
        $this->paymobService = $paymobService;
    }


    public function index()
    {

        //  $payments = Payment::all();
        $cities = City::all();
        $governorates = Governorate::all();
        $payments = Payment::where('is_active', 1)->get();

        $cart = auth()->user()->cart;

        return view('site.checkout.index', compact('cart', 'cities', 'governorates', 'payments'));
    }

    public function store(Request $request)
    {
        $payment = Payment::where('id', $request->puy)->first();

        $cart = $this->getCart();
        $address = $this->getAddress($request->address_id);
        if ($address->governorate->tax == 0 || $address->governorate->tax == null) {
            return redirect()->back()->with('error', transWord('Please select a city with a tax'));
        }
        if (!$cart || !$address || !$payment) {
            return redirect()->back()->with('error', transWord('Unable to process the order. Please try again'));
        }
        $this->updateCart($cart, $request, $address, $payment);
        if ($payment->is_cash == 1) {

            // Set the timezone to Egypt time
            //     $dateTime->setTimezone(new DateTimeZone('Africa/Cairo'));

            // Format the DateTime object to the desired format


            $cart->update([
                'status' => 'pending',
                'payment_id' => $payment->id,
                'type' => 'order',
                'payment_method' => 'cash',
                'created_at' => now(),
                'type_order' => 'user',
            ]);
            User::role('admin')->first()->notify(new OrdersNotifiction($cart));

            return redirect()->route('site.checkout.accepte', $cart->id)->with('success', transWord('Order has been placed successfully'));
            //  return view('site.profile.orders_success', compact('order'));

            // return redirect()->route('site.orders')->with('success', transWord('Order has been placed successfully'));
        }
        $orderData = $this->prepareOrderData($cart, $request);
        $order = $this->paymobService->createOrder($orderData);

        $paymentKeyData = $this->preparePaymentKeyData($orderData, $request, $address, $order);
        $paymentKey = $this->paymobService->createPaymentKey($paymentKeyData);

        return redirect($this->paymobService->getIframeUrl($paymentKey['token'], $payment->PAYMOB_IFRAME_ID));
    }

    public function callback(Request $request)
    {
        $data = $request->all();

        if (!$this->isValidHmac($data)) {
            return $this->handlePaymentFailure();
        }

        return $this->processPaymentStatus($data);
    }

    public function tax(Request $request)
    {
        $address = $this->getAddress($request->address_id);
        $gov = Governorate::find($address->governorate_id);
        $order = $this->getCart();
        $order->update([
            'tax' => $gov->tax

        ]);
        return response()->json(['tax' => $gov->tax, 'message' => transWord('tax updated successfully')]);
    }

    public function merchant(Request $request)
    {
$payment = Payment::where('id', $request->puy)->first();

        $cart = $this->getCart();
        $address = $this->getAddress($request->address_id);
        if ($address->governorate->tax == 0 || $address->governorate->tax == null) {
            return redirect()->back()->with('error', transWord('Please select a city with a tax'));
        }
        if (!$cart || !$address ) {
            return redirect()->back()->with('error', transWord('Unable to process the order. Please try again'));
        }
        $this->updateCart($cart, $request, $address, $payment);
        if ($payment->is_cash == 1) {

            $cart->update([
                'status' => 'pending',
               // 'payment_id' => $payment->id,
                'type' => 'order',
                'payment_method' => 'cash',
                'created_at' => now(),
                'type_order' => 'merchant',
            ]);
            User::role('admin')->first()->notify(new OrdersNotifiction($cart));

            return redirect()->route('site.checkout.accepte', $cart->id)->with('success', transWord('Order has been placed successfully'));
            //  return view('site.profile.orders_success', compact('order'));

            // return redirect()->route('site.orders')->with('success', transWord('Order has been placed successfully'));
        }
    }

    public function accepte($order_id)
    {

        $order = auth()->user()->orders()->where('id', $order_id)->first();
        return view('site.profile.orders_success', compact('order'));
    }
}
