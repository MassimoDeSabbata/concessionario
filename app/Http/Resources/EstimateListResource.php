<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EstimateListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'id' => $this->id,
            'price' => $this->price,
            'car' => new CarSimpleResource($this->car),
            'author' => new UserSimpleResource($this->author),
            'customer' => new UserSimpleResource($this->customer)
        ]
        ;
    }
}
