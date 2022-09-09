<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Variance\VarianceResource;
use App\Http\Resources\Variance\VariancesResource;
use App\Models\Options;
use App\Models\OptionVariance;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        $variance = @$this->resource->variance;
    //  Filter by request --------------------------------------------
        $filter = @$request->get('filter');
        if($filter){
            if(key_exists('max_price',$filter )){
                $variance = $variance->where('price', '<=', $filter['max_price']);
            }
            if(key_exists('options',$filter )){
                $optionsFilter = $filter['options'];
                $attributes = Options::query()->whereIn('value', explode(',', $optionsFilter))->get();
                $attributes_with_Variance = OptionVariance::query()->whereIn('option_id', @$attributes->pluck('id'))->get();
                $variance = $variance->whereIn('id', $attributes_with_Variance->pluck('variance_id'));
            }
        }
    //  End Filter by request ----------------------------------------


        return [
            'product' =>[
                'id' => $this->resource->id,
                'title' => $this->resource->title,
                'average_rating' => $this->resource->average_rating,
                'is_in_stock' => $this->resource->stock_status,
                'status' => $this->resource->status,
                'options' => $this->resource->options->pluck('name'),
                'default_variant' => new VarianceResource(@$this->resource->defaultVariation()),
                'variance' =>new VariancesResource($variance)
            ],
        ];

    }
}
