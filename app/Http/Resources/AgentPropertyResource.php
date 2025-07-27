<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentPropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'for_what' => $this->for_what,
            'owner_name' => $this->owner_name,
            'society_tower_room_no' => $this->society_tower_room_no,
            'located_at' => $this->located_at,
            'baths' => $this->baths,
            'bhk' => $this->bhk,
            'beds' => $this->beds,
            'sqft' => $this->sqft,
            'balconies' => $this->balconies,
            'carpet_area' => $this->carpet_area,
            'floor_no' => $this->floor_no,
            'property_age' => $this->property_age,
            'no_of_lifts' => $this->no_of_lifts,
            'available_from' => Carbon::parse($this->available_from)->format('d M, Y'),
            'overview' => $this->overview,
            'amenities' => $this->amenities,
            'price' => $this->price,
            'upload_photo' => $this->upload_photo,
            'facing' => $this->facing,
            'furnishing' => $this->furnishing,
            'pet_friendly' => $this->pet_friendly,
            'created_at' => Carbon::parse($this->created_at)->format('d M, Y'),
        ];

        if ($this->for_what === 'Rent') {
            $data['rent_agreement_duration'] = $this->rent_agreement_duration;
            $data['electricity_and_water_charge'] = $this->electricity_and_water_charge;
        }
        return $data;
    }
}
