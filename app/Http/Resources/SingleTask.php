<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Worker as WorkerResource;

class SingleTask extends JsonResource
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
            'name' => $this->name,
            'start' => $this->start,
            'finish' => $this->finish,
            'status' => $this->status,
            'closed' => $this->closed,
            'date' => $this->date,
            'aw' => $this->aw->name,
            'aw_client' => $this->aw->client,
            'aw_tour_number' => $this->aw->tour_number,
            'aw_loading_date' => $this->aw->loading_date,
            'aw_coli' => $this->aw->coli,
            'aw_led' => $this->aw->led,
            'aw_dif' => $this->aw->coli - $this->aw->led,
            'aw_wmk_not_collection' => $this->coli - $this->wm_quantity,
            'workers' => WorkerResource::collection($this->workers)
        ];
    }
}
