<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'customer_id' => $this->customer_id,
            'product_id'  => $this->product_id,
            'quantity'    => $this->quantity,
            'product'     => [
                'id'          => $this->product->id,
                'name'        => $this->product->name,
                'slug'        => $this->product->slug,
                'price'       => $this->product->price,
                'description' => $this->product->description,
                'status'      => $this->product->status,
                'images'      => $this->product->images->map(function ($image) {
                    return [
                        'id'         => $image->id,
                        'product_id' => $image->product_id,
                        'images'     => $image->images,
                    ];
                }),
            ],
        ];
    }
}
