<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1','middleware' => 'throttle:api'],function ($router) {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [AuthController::class,'register']);
        Route::post('login', [AuthController::class,'login']);
        Route::post('logout',[AuthController::class,'logout']);
    });

    Route::group(['middleware'=>'auth:api'], function () {


    });

});
