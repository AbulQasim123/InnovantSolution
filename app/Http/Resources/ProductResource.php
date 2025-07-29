<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'price'       => $this->price,
            'description' => $this->description,
            'status'      => $this->status,
            'images'      => ImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
