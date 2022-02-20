<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "purchase_price" => $this->purchase_price,
            "price" => $this->price,
            "profit" => $this->profit,
            "customer" => new WithCustomerResource($this->customer),
            "image" => $this->image,
            "description" => $this->description,
            "note" => $this->note,
            "created_at" => $this->created_at
        ];
    }
}
