<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/product/search/{name}', 'ProductController@search');


// Route::middleware('auth:sanctum')->get('/user', function () {
//     Route::get('/product/search/{name}', 'ProductController@search');
// });
