<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SharedPropertyItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'property' => [
                'id' => $this->property->id,
                'agent_id' => $this->property->agent_id,
                'for_what' => $this->property->for_what,
                'owner_name' => $this->property->owner_name,
                'society_tower_room_no' => $this->property->society_tower_room_no,
                'located_at' => $this->property->located_at,
                'baths' => $this->property->baths,
                'beds' => $this->property->beds,
                'sqft' => $this->property->sqft,
                'balconies' => $this->property->balconies,
                'carpet_area' => $this->property->carpet_area,
                'floor_no' => $this->property->floor_no,
                'property_age' => $this->property->property_age,
                'no_of_lifts' => $this->property->no_of_lifts,
                'available_from' => $this->property->available_from,
                'overview' => $this->property->overview,
                'amenities' => $this->property->amenities,
                'price' => $this->property->price,
                'upload_photo' => $this->property->upload_photo,
                'facing' => $this->property->facing,
                'furnishing' => $this->property->furnishing,
                'pet_friendly' => $this->property->pet_friendly,
                'rent_agreement_duration' => $this->property->rent_agreement_duration,
                'electricity_and_water_charge' => $this->property->electricity_and_water_charge,
                'status' => $this->property->status,
            ],
        ];
    }
}
