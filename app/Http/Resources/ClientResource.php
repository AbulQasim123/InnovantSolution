<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'role' => $this->role,
            'mobile' => $this->mobile,
            'current_location' => $this->current_location,
            'work_profile' => $this->work_profile,
            'profile' => $this->profile,
            'agent' => [
                'id' => $this->agent->id,
                'name' => $this->agent->name
            ],
        ];
    }
}
