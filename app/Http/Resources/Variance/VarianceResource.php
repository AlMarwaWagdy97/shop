<?php

namespace App\Http\Resources\Variance;

use Illuminate\Http\Resources\Json\JsonResource;

class VarianceResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'product' =>[
                'id' => $this->resource->id,
                'title' => $this->resource->title,
                'option1' => $this->resource->option1,
                'option2' => $this->resource->option2,
                'price' => $this->resource->price,
                'stock' => $this->resource->stock,
                'is_in_stock' => @$this->resource->stock_status,
                'status' => $this->resource->status,
            ],
        ];

    }
}
