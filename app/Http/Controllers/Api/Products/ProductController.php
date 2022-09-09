<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductsResource;
use App\Models\Options;
use App\Models\OptionVariance;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request){
        $products = Products::query();

//  Filter by request -----------------------------------------------------
        $filter = @$request->get('filter');
        if($filter){
            if(key_exists('average_rating',$filter )){
                $avgFilter = $filter['average_rating'];
                $products->where('average_rating', $avgFilter);
            }
            if(key_exists('options',$filter )){
                $optionsFilter = $filter['options'];
                $attributes = Options::query()->whereIn('value', explode(',', $optionsFilter))->get();
                $attributes_with_Variance = OptionVariance::query()->whereIn('option_id', @$attributes->pluck('id'))->get();
                $products->whereHas('variance' , function($q) use ($attributes_with_Variance){
                     $q->whereIn('id', $attributes_with_Variance->pluck('variance_id'));
                });
            }
            if(key_exists('max_price',$filter )){
                $maxPriceFilter = $filter['max_price'];
                $products->whereHas('variance' , function($q) use ($maxPriceFilter){
                    $q->where('price', '<=', $maxPriceFilter);
                });
            }

        }
//  End Filter by request -----------------------------------------

        $products = $products->get();
        return $this->responseData(new ProductsResource($products));

    }
}
