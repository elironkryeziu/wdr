<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DailyTask extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'daily',
            'id' => $this->id,
            'name' => $this->name,
            // 'status' => $this->status, -ma vone
            // 'workers' => WorkerResource::collection($this->workers)
        ];
    }
}