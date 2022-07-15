<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client' => $this->user->full_name,
            'cost' => $this->products->pluck('price')->reduce(fn ($carry, $item) => $carry + $item),
            'approved_at' => $this->approved_at->format('d.m.Y H:i:s'),
            'products' => ProductResource::collection($this->products)
        ];
    }
}
