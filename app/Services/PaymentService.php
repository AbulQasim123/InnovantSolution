<?php

namespace App\Services;

use Razorpay\Api\Api;
use App\Models\Order;

class PaymentService
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
    }

    public function createRazorpayOrder(Order $order)
    {
        $razorpayOrder = $this->api->order->create([
            'receipt'         => $order->order_number,
            'amount'          => $order->total_amount * 100,
            'currency'        => 'INR',
            'payment_capture' => 1
        ]);

        return [
            'razorpay_order_id' => $razorpayOrder['id'],
            'amount'            => $razorpayOrder['amount'],
            'currency'          => $razorpayOrder['currency'],
            'key'               => config('services.razorpay.key'),
        ];
    }

    public function verifySignature($razorpayOrderId, $razorpayPaymentId, $razorpaySignature)
    {
        $generatedSignature = hash_hmac(
            'sha256',
            $razorpayOrderId . '|' . $razorpayPaymentId,
            config('services.razorpay.secret')
        );

        return hash_equals($generatedSignature, $razorpaySignature);
    }
}
