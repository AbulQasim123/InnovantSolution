<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'orderItemId'          => $this->id,
            'orderId'    => $this->order_id,
            'productId'  => $this->product_id,
            'quantity'    => $this->quantity,
            'price'       => $this->price,
            'createdAt'  => $this->created_at->toDateTimeString(),
            // 'updatedAt'  => $this->updated_at->toDateTimeString(),
            'product'     => [
                'productId'          => $this->product->id ?? null,
                'name'        => $this->product->name ?? null,
                'slug'        => $this->product->slug ?? null,
                'price'       => $this->product->price ?? null,
                'quantity'    => $this->product->quantity ?? null,
                'description' => $this->product->description ?? null,
                'status'      => $this->product->status ?? null,
            ],
        ];
    }
}

