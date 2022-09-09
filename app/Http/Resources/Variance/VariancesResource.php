<?php

namespace App\Http\Resources\Variance;

use Illuminate\Http\Resources\Json\JsonResource;

class VariancesResource extends JsonResource
{

    public function toArray($request)
    {
        return $this->resource->map(function($item){
           return new VarianceResource($item);
        });
    }
}
