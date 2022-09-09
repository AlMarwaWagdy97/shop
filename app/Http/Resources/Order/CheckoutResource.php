<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckoutResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'price' => $this->resource->price,
            'quantity' => $request->get('quantity'),
            'Total Price' => $request->get('quantity') * $this->resource->price,
        ];
    }
}
