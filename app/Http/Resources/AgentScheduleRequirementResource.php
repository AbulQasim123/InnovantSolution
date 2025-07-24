<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentScheduleRequirementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'role' => $this->role,
            'for_what' => $this->for_what,
            'home_type' => $this->home_type,
            'meet_type' => $this->meet_type,
            'budget' => $this->budget,
            'date' => $this->date,
            'time' => $this->time,
            'status' => $this->status,
            'client' => $this->client ? [
                'id' => $this->client->id,
                'first_name' => $this->client->first_name,
                'last_name' => $this->client->last_name,
                'mobile' => $this->client->mobile,
                'profile' => $this->client->profile,
            ] : null,
            'feedback' => $this->feedback,
        ];
    }
}

// 'location' => $this->location,
// 'key_handover' => $this->key_handover,
// 'maintenance_service' => $this->maintenance_service,
// 'requirement_status' => $this->requirement_status,
// 'meet_type' => $this->meet_type,
// 'schedule_status' => $this->schedule_status,
