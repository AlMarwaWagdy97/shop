<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{

    public function toArray($request)
    {
        return $this->resource->map(function($item){
           return new ProductResource($item);
        });
    }
}
