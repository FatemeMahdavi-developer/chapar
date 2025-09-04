<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\OrderController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1','middleware' => 'throttle:api'],function ($router) {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [AuthController::class,'register']);
        Route::post('login', [AuthController::class,'login']);
        Route::post('logout',[AuthController::class,'logout']);
    });

    // Route::group(['middleware'=>'auth:api'], function () {
        Route::post("order",[OrderController::class,'store']);
        Route::get("order",[OrderController::class,'index']);
        Route::patch('/order/{barcode}/status', [OrderController::class, 'updateStatus']);
        Route::delete('/order/{order}', [OrderController::class, 'destroy']);
    // });

});
