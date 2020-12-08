<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Worker extends JsonResource
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
            'initials' => substr($this->first_name, 0, 1).substr($this->last_name, 0, 1),
            'name' => $this->first_name. ' '.$this->last_name,
            'number' => $this->number,
        ];
    }
}
