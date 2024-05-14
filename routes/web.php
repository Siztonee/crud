<?php

use Illuminate\Support\Facades\Route;



Route::group(['namespace' => 'App\Http\Controllers\Post'], function () {
    Route::get('/posts', 'IndexController')->name('post.index');
    Route::get('/posts/create', 'CreateController')->name('post.create');
    Route::post('/posts', 'StoreController')->name('post.store');
    Route::get('/posts/{post}', 'ShowController')->name('post.show');
    Route::get('/posts/{post}/edit', 'EditController')->name('post.edit');
    Route::patch('/posts/{post}', 'UpdateController')->name('post.update');
    Route::delete('/posts/{post}', 'DestroyController')->name('post.delete');
});



Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => 'App\Http\Middleware\AdminPanelMiddleware'], function () {
    Route::group(['namespace' => 'Post'], function () {
        Route::get('/post', 'IndexController')->name('admin.post.index');
    });
});



Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'HomeController@index')->name('home');


    Route::get('/posts/update', 'PostController@update');
    Route::get('/posts/delete', 'PostController@delete');
    Route::get('/posts/first_or_create', 'PostController@firstOrCreate');
    Route::get('/posts/update_or_create', 'PostController@updateOrCreate');

    Route::get('/about', 'AboutController@index')->name('about.index');
    Route::get('/contacts', 'ContactController@index')->name('contact.index');
    Route::get('/main', 'MainController@index')->name('main.index');

});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
