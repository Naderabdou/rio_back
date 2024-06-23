<?php

namespace App\Http\Controllers\site;

use App\Models\City;
use App\Models\Payment;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Services\PaymobService;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
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
        // $request->validate([
        //     'address_id' => 'required|integer',
        //     'phone' => 'required',
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'total_price' => 'required|numeric',
        //     'price_before_discount' => 'required|numeric',
        //     'tax' => 'nullable|numeric',
        //     'payment_method' => 'required',
        // ]);

        $cart = $this->getCart();
        $address = $this->getAddress($request->address_id);

        if (!$cart || !$address) {
            return redirect()->back()->withErrors('Unable to process the order.');
        }

        $this->updateCart($cart, $request, $address);

        $orderData = $this->prepareOrderData($cart, $request);
        $order = $this->paymobService->createOrder($orderData);

        $paymentKeyData = $this->preparePaymentKeyData($orderData, $request, $address, $order);
        $paymentKey = $this->paymobService->createPaymentKey($paymentKeyData);

        return redirect($this->paymobService->getIframeUrl($paymentKey['token']));
    }

    private function getCart()
    {
        return auth()->user()->cart;
    }

    private function getAddress($addressId)
    {
        return auth()->user()->address()->find($addressId);
    }

    private function updateCart($cart, $request, $address)
    {
        $cart->update([
            'address_id' => $request->address_id,
            'phone' => $request->phone,
            'name' => $request->name,
            'email' => $request->email,
            'total_price' => $request->total_price,
            'price_before_discount' => $request->price_before_discount,
            'tax' => $request->tax ?? 20,
            'payment_method' => $request->payment_method,
            'address' => $address->street,
            'city' => $address->city->name,
            'governorate' => $address->governorate->name,
        ]);
    }

    private function prepareOrderData($cart, $request)
    {
        $items = $cart->orderItems->map(function ($item) {
            return [
                'name' => $item->product_name,
                'amount_cents' => $item->price * 100,
                'quantity' => $item->quantity,
            ];
        })->toArray();

        return [
            'delivery_needed' => false,
            'amount_cents' => $cart->price_before_discount, // Consider fetching this from $cart or calculating dynamically
            'currency' => 'EGP',
            'merchant_order_id' => uniqid(),
            'items' => $items,
        ];
    }

    private function preparePaymentKeyData($orderData, $request, $address, $order)
    {
        return [
            'amount_cents' => $orderData['amount_cents'],
            'currency' => 'EGP',
            'order_id' => $order['id'],
            'billing_data' => [
                'apartment' => 'NA',
                'floor' => 'NA',
                'email' => $request->email,
                'first_name' => $request->name,
                'street' => $address->street,
                'building' => 'NA',
                'phone_number' => $request->phone,
                'shipping_method' => 'NA',
                'postal_code' => 'NA',
                'city' => $address->city->name,
                'country' => $address->governorate->name,
                'last_name' => $request->name,
                'state' => 'NA',
            ],
            'integration_id' => $this->paymobService->getIntegrationId(),
        ];
    }
}
