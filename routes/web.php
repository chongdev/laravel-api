<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return abort(403);
});

Route::post('/register', 'MemberAuthController@register');
Route::post('/login', 'MemberAuthController@login');

Route::group(['middleware' => 'cors'], function () {
    Route::resource('/product', 'ProductController');
});
// Route::get('/product/search/{name}', 'ProductController@search');

Route::group(['middleware' => ['auth:sanctum', 'cors']], function () {
    Route::get('/product/search/{name}', 'ProductController@search');

    Route::get('/user', 'MemberAuthController@user');
    Route::post('/logout', 'MemberAuthController@logout');
});

// Route::get('/oauth/redirect', 'OAuthController@redirect');
// Route::get('/oauth/callback', 'OAuthController@callback');
