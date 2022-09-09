<?php

namespace App\Http\Controllers\Api\Orders;

use App\Enums\BaseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\CheckoutResource;
use App\Mail\NotifyOutOfStock;
use App\Models\Variance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\isJson;


class OrderController extends Controller
{
    public function postCheckOut(Request $request){
        if($request->get('product_id') == null || $request->get('quantity') == null ){
            return $this->responseData([], trans('main.request_order_required'));
        }
        $variance = Variance::find($request->get('product_id'));
        $quantityOrdered = $request->get('quantity');

        $checkavariable = $this->CheckAvailableProduct($variance,$quantityOrdered);
        if($checkavariable != ""){
            return $this->responseData([], $checkavariable);
        }
        $this->updateStock($variance, $quantityOrdered);
        return $this->responseData(new CheckoutResource($variance));
    }





    private function CheckAvailableProduct($variance, $quantityOrdered){
        //  if product is not publish or notfound ----------------------------------------------------------
        if($variance->status !=  BaseStatusEnum::PUBLISHED){return trans('main.not_found');}

        //  if product is out of stock ----------------------------------------------------------
        if($variance->is_in_stock != 1 || $variance->stock <= 0){return trans('main.product_out_of_stock');}

        //  if product max quantity ----------------------------------------------------------
        if( $variance->stock < $quantityOrdered){return trans('main.maximum_quantity_is_:max!', ['max' => $variance->stock]);}

        return "";
    }

    private function updateStock($variance, $quantityOrdered){
        $variance->update(['stock' => $variance->stock - $quantityOrdered]);
        $product = $variance->product;

        if($variance->stock <= 0){
            $variance->update(['is_in_stock' => 0]);
//            change default product if out of stock
            if($product->default_variant == $variance->id){
                $minPrice = $product->variance->where('is_in_stock', 1)->whereNotNull('price')->min('price');
                $newDefult = $product->variance->where('is_in_stock', 1)->where('price', $minPrice)->first();
                if($newDefult != null)$product->update(['default_variant' => @$newDefult->id]);
            }
        }

        if($product->variance->sum('is_in_stock') <= 0){
            $product->update(['is_in_stock' => 0]);
            $this->notifyOutOfStock($product);
        }
    }

    private function notifyOutOfStock($product){
        Mail::to(env('ADMIN_MAIL', 'admin@34ml.com'))->send(new NotifyOutOfStock($product));
        event(new NotifyOutOfStock($product));
    }

}
