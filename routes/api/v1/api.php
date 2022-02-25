<?php

use Illuminate\Support\Facades\Route;

Route::post('/auth/login', 'API\v1\AuthController@login');
Route::post('/auth/signup', 'API\v1\AuthController@signup');

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('auth/logout', 'API\v1\AuthController@logout');
    Route::get('auth/user', 'API\v1\AuthController@user');
});
