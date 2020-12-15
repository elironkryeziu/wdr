<?php

namespace App\Http\Resources;

use App\Http\Resources\Worker as WorkerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UsualTask extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'start' => $this->start,
            'finish' => $this->finish,
            'status' => $this->status,
            'closed' => $this->closed,
            'date' => $this->date,
            'workers' => WorkerResource::collection($this->workers)
        ];
    }
}
