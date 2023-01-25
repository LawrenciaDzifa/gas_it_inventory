<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});












Route::resource('items', App\Http\Controllers\API\ItemAPIController::class);






Route::resource('categories', App\Http\Controllers\API\CategoryAPIController::class);




Route::resource('stocks', App\Http\Controllers\API\StockAPIController::class);


Route::resource('stock_histories', App\Http\Controllers\API\StockHistoryAPIController::class);






Route::resource('requisitions', App\Http\Controllers\API\RequisitionAPIController::class);


Route::resource('restocks', App\Http\Controllers\API\RestockAPIController::class);
