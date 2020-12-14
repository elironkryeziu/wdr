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
            'initials' => $this->initials,
            'name' => $this->fullName,
            'number' => $this->number,
        ];
    }
}
