<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadLatestCommentStatus extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'associate_id' => $this->associate_id,
            'project_id' => $this->project_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'building_type' => $this->building_type,
            'requirement' => $this->requirement,
            'budget' => $this->budget,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'latest_comment' => $this->latestComment?->status,
        ];
    }
}
