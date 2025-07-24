<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SharePropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'agent_id' => $this->agent_id,
            'client_id' => $this->client_id,
            'property_id' => $this->property_id,
            'status' => $this->status,
            'property' => [
                'id' => $this->property->id,
                'society_tower_room_no' => $this->property->society_tower_room_no,
                'upload_photo' => $this->property->upload_photo,
                'located_at' => $this->property->located_at,
                'baths' => $this->property->baths,
                'beds' => $this->property->beds,
                'sqft' => $this->property->sqft,
                'price' => $this->property->price,
            ]
        ];
    }
}
