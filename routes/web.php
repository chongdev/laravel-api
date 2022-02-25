<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function ()
{
    return abort(403);
});

Route::post('/register', 'MemberAuthController@register');
Route::post('/login', 'MemberAuthController@login');
Route::resource('/product', 'ProductController');
// Route::get('/product/search/{name}', 'ProductController@search');

Route::group(['middleware'=>'auth:sanctum'], function () {
    Route::get('/product/search/{name}', 'ProductController@search');

    Route::post('/logout', 'MemberAuthController@logout');
});