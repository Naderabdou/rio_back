<?php

namespace App\Traits;

use DateTime;
use DateTimeZone;
use App\Models\User;
use App\Models\Order;
use App\Notifications\OrdersNotifiction;

trait PaymentsMethod
{

    public function isValidHmac($data)
    {
        if (!isset($data['hmac'])) {
            return false;
        }

        ksort($data);
        $hmac = $data['hmac'];
        $filteredData = $this->filterDataForHmac($data);
        $secret = env('PAYMOB_HMAC_SECRET');
        $hashed = hash_hmac('sha512', $filteredData, $secret);

        return $hashed === $hmac;
    }


    public function filterDataForHmac($data)
    {
        $keys = [
            'amount_cents', 'created_at', 'currency', 'error_occured', 'has_parent_transaction',
            'id', 'integration_id', 'is_3d_secure', 'is_auth', 'is_capture', 'is_refunded',
            'is_standalone_payment', 'is_voided', 'order', 'owner', 'pending', 'source_data_pan',
            'source_data_sub_type', 'source_data_type', 'success',
        ];

        $connectedString = '';
        foreach ($data as $key => $value) {
            if (in_array($key, $keys)) {
                $connectedString .= $value;
            }
        }

        return $connectedString;
    }

    public function processPaymentStatus($data)
    {


        // Set the timezone to Egypt time
   //     $dateTime->setTimezone(new DateTimeZone('Africa/Cairo'));

        // Format the DateTime object to the desired format
        // $formattedTimestamp = $dateTime->format('Y-m-d H:i:s');

        // $data['created_at'] = $formattedTimestamp;

        if ($data['success'] == true) {
            return $this->handlePaymentSuccess($data);
        } else {
            return $this->handlePaymentFailure();
        }
    }

    public function handlePaymentSuccess($data)
    {
        $order = Order::where('merchant_order_id', request('merchant_order_id'))->first();
        $order->update(
            ['type' => 'order', 'payment_method' => $data['source_data_sub_type'] , 'created_at' => now() , 'type_order' => 'user',]
        );

        User::role('admin')->first()->notify(new OrdersNotifiction($order));
        return redirect()->route('site.checkout.accepte', $order->id)->with('success', transWord('Order has been placed successfully'));

    }

    public function handlePaymentFailure()
    {
        return redirect()->route('site.checkout')->with('error', transWord('فشلت عملية الدفع'));
    }

    public function updateCart($cart, $request, $address, $payment)
    {
         auth()->user()->update([
            'additional_phone' => $request->additional_phone,
        ]);
        $cart->update([
            'address_id' => $request->address_id,
            'phone' => $request->phone,
            'name' => $request->name,
            'email' => $request->email,
            // 'total_price' => $request->total_price,
            // 'price_before_discount' => $request->price_before_discount,

            //'payment_method' => $payment->name_en,
            'payment_id' => $payment->id,
            'address' => $address->street,
            'city' => $address->city->name,
            'country' => $address->governorate->name,
            'merchant_order_id' => uniqid()
        ]);
    }

    public function prepareOrderData($cart, $request)
    {

        $amount_cents = ($cart->price_before_discount + $cart->tax) - $cart->coupon_value;
        $items = $cart->orderItems->map(function ($item) {
            return [
                'name' => $item->product_name,
                'amount_cents' => $item->price * 100,
                'quantity' => $item->quantity,
            ];
        })->toArray();
        return [
            'delivery_needed' => false,
            'amount_cents' => $amount_cents * 100, // Consider fetching this from $cart or calculating dynamically
            'currency' => 'EGP',
            'merchant_order_id' => $cart->merchant_order_id,
            'items' => $items,
        ];
    }

    public function preparePaymentKeyData($orderData, $request, $address, $order)
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

    public function getCart()
    {
        return auth()->user()->cart;
    }

    public function getAddress($addressId)
    {
        return auth()->user()->address()->find($addressId);
    }
}
