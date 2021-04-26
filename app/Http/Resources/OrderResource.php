<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'observation' => $this->observation,
            'payment_method' => $this->payment_method,
            'client_id' => $this->client_id,
            'products' => ProductResource::collection($this->products),
            'total' => $this->total,
        ];
    }
}
