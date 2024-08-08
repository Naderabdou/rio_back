<?php

namespace App\Traits;

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
        if ($data['success'] == true) {
            return $this->handlePaymentSuccess();
        } else {
            return $this->handlePaymentFailure();
        }
    }

    public function handlePaymentSuccess()
    {
        $order = $this->getCart();
        $order->update(['type' => 'order']);
        return redirect()->route('site.orders')->with('success', transWord('تم الدفع بنجاح'));
    }

    public function handlePaymentFailure()
    {
        return redirect()->route('checkout.index')->with('error', transWord('فشلت عملية الدفع'));
    }
}
