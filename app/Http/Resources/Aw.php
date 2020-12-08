<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Task as TaskResource;


class Aw extends JsonResource
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
            'client' => $this->client,
            'tour_number' => $this->tour_number,
            'loading_date' => $this->loading_date,
            'coli' => $this->coli,
            'led' => $this->led,
            'dif' => $this->coli - $this->led,
            'wmk_not_collection' => $this->coli - $this->wm_quantity,
            'tasks' => TaskResource::collection($this->tasks)
        ];
    }
}
