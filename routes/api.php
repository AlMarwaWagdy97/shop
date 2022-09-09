<?php

use App\Http\Controllers\Api\Orders\OrderController;
use App\Http\Controllers\Api\Products\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::group(['as' => 'api.'], function () {

// front Products api ----------------------------------------------------------------
    Route::controller(ProductController::class)->group(function(){
        Route::get('/products', 'show');
    });
// End front Products api ------------------------------------------------------------


// front Order api ----------------------------------------------------------------
    Route::controller(OrderController::class)->group(function(){
        Route::post('/order', 'postCheckOut');
    });
// End front Order api ------------------------------------------------------------

});
