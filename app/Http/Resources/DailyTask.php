<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Worker as WorkerResource;


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
            'status' => $this->status,
            'start' => $this->start,
            'finish' => $this->finish,
            'workers' => WorkerResource::collection($this->workers)
        ];
    }
}
