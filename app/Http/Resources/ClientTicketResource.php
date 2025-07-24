<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientTicketResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'case_id' => $this->case_id,
            'subject' => $this->subject,
            'role' => $this->role,
            'summary' => $this->summary,
            'upload_photo' => $this->upload_photo,
            'status' => $this->status,
            'created_at' => Carbon::parse($this->created_at)->format('d M, Y'),
            'property_id'  => $this->property->id,
            'property_name'  => $this->property->society_tower_room_no
        ];
    }
}
