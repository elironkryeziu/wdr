<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Worker as WorkerResource;

class Task extends JsonResource
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
            'aw' => $this->aw->name,
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
