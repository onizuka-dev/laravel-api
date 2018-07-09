<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::resource('products', 'ProductsController')->middleware('auth:api');
    Route::apiResource('taxes', 'TaxesController');
});
