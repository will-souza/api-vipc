<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'size' => $this->size,
            'price' => $this->price,
        ];

        if ($this->pivot) $data['quantity'] = $this->pivot->quantity;

        return $data;
    }
}
