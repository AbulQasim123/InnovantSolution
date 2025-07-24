<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupedSharedPropertyResource extends JsonResource
{
    // public function toArray(Request $request): array
    // {
    //     $client = $this->first()->client;

    //     return [
    //         'client' => [
    //             'id' => $client->id,
    //             'agent_id' => $client->agent_id,
    //             'first_name' => $client->first_name,
    //             'last_name' => $client->last_name,
    //             'mobile' => $client->mobile,
    //             'email' => $client->email,
    //             'profile' => $client->profile,
    //             'address' => $client->address,
    //             'source' => $client->source,
    //             'role' => $client->role,
    //             'current_location' => $client->current_location,
    //             'work_profile' => $client->work_profile,
    //         ],
    //         'documents' => $client->documents ? [
    //             'id' => $client->documents->id,
    //             'client_id' => $client->documents->client_id,
    //             'pan_card' => $client->documents->pan_card,
    //             'aadhar_card' => $client->documents->aadhar_card,
    //             'voter_id' => $client->documents->voter_id,
    //             'ration_card' => $client->documents->ration_card,
    //             'family_photo' => $client->documents->family_photo,
    //         ] : null,
    //         'shared_properties' => SharedPropertyItemResource::collection($this->values()),
    //     ];
    // }

    public function toArray(Request $request): array
    {
        $first = $this->first();
        $client = $first->client;

        return [
            'client' => [
                'id' => $client->id,
                'agent_id' => $client->agent_id,
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'mobile' => $client->mobile,
                'email' => $client->email,
                'profile' => $client->profile,
                'address' => $client->address,
                'source' => $client->source,
                'role' => $client->role,
                'current_location' => $client->current_location,
                'work_profile' => $client->work_profile,
            ],
            'documents' => $client->documents ? [
                'id' => $client->documents->id,
                'client_id' => $client->documents->client_id,
                'pan_card' => $client->documents->pan_card,
                'aadhar_card' => $client->documents->aadhar_card,
                'voter_id' => $client->documents->voter_id,
                'ration_card' => $client->documents->ration_card,
                'family_photo' => $client->documents->family_photo,
            ] : null,
            'shared_properties' => $this->contains(fn($item) => $item->property)
                ? SharedPropertyItemResource::collection($this->values())
                : null,
        ];
    }
}
