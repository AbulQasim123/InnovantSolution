<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'orderId'                 => $this->id,
            'customerId'        => $this->customer_id,
            'orderNumber'       => $this->order_number,
            'totalAmount'       => $this->total_amount,
            'status'            => $this->status,
            'shippingName'      => $this->shipping_name,
            'shippingPhone'     => $this->shipping_phone,
            'shippingAddress'   => $this->shipping_address,
            'createdAt'         => $this->created_at->toDateTimeString(),
            // 'updatedAt'         => $this->updated_at->toDateTimeString(),
            'items'              => OrderItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
