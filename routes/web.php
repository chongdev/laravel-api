<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function ()
{
    return abort(403);
});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::resource('/product', 'ProductController');
// Route::get('/product/search/{name}', 'ProductController@search');

Route::group(['middleware'=>'auth:sanctum'], function () {
    Route::get('/product/search/{name}', 'ProductController@search');

    Route::post('/logout', 'AuthController@logout');
});