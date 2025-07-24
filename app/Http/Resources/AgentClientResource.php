<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentClientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $array = [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'mobile'     => $this->mobile,
            'email'      => $this->email,
            'address'    => $this->address,
            'profile'    => $this->profile,
            'source'     => $this->source,
            'role'       => $this->role,
            'joined_at'  => Carbon::parse($this->created_at)->format('d M, Y'),
            'icon_status'       => $this->icon_status,
            'no_requirement_status'      => $this->requirement_status,
            'requirement_status'      => $this->scheduleRequirements->requirement_status ?? "no",
            'schedule_status'      => $this->scheduleRequirements->schedule_status ?? "no",
        ];


        // Only include schedule_requirements when calling getClient route
        if ($request->routeIs('agent.get.client')) {
            $schedule = $this->scheduleRequirements;

            $array['schedule_requirements'] = $schedule
                ? [
                    'id'        => $schedule->id,
                    'for_what'  => $schedule->for_what,
                    'home_type' => $schedule->home_type,
                    'budget'    => $schedule->budget,
                    'date'      => $schedule->date,
                    'time'      => $schedule->time,
                    // 'requirement_status'      => $schedule->requirement_status,
                    // 'schedule_status'      => $schedule->schedule_status,
                ]
                : [];
        }
        return $array;
    }
}
