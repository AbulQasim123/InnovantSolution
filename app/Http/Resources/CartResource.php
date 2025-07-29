<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'cartId'          => $this->id,
            'customerId' => $this->customer_id,
            'productId'  => $this->product_id,
            'quantity'    => $this->quantity,
            'product'     => [
                'productId'   => $this->product->id,
                'name'        => $this->product->name,
                'slug'        => $this->product->slug,
                'price'       => $this->product->price,
                'description' => $this->product->description,
                'status'      => $this->product->status,
                'images'      => $this->product->images->map(function ($image) {
                    return [
                        'imageId'         => $image->id,
                        'productId' => $image->product_id,
                        'images'     => $image->images,
                    ];
                }),
            ],
        ];
    }
}
