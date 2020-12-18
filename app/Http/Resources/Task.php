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
            'id' => $this->id,
            'aw' => $this->aw->name,
            'name' => $this->name,
            'notes' => $this->notes,
            'start' => $this->start,
            'finish' => $this->finish,
            'status' => $this->status,
            'closed' => $this->closed,
            'date' => $this->date,
            'workers' => WorkerResource::collection($this->workers)
        ];
    }
}
