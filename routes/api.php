<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});


Route::group([
    'namespace' => 'App\Http\Controllers\Post',
    'middleware' => 'jwt.auth'
], function () {
    Route::get('/posts', 'IndexController');
    Route::get('/posts/create', 'CreateController');
    Route::post('/posts', 'StoreController');
    Route::get('/posts/{post}', 'ShowController');
    Route::get('/posts/{post}/edit', 'EditController');
    Route::patch('/posts/{post}', 'UpdateController');
    Route::delete('/posts/{post}', 'DestroyController');
});
