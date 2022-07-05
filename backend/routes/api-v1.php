<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'default'], function () {
    Route::get('', 'DefaultController@index')->name('default.index');
    Route::get('view/{id}', 'DefaultController@show')->name('default.show')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', ['middleware' => 'guest', 'uses' => 'AuthController@register'])->name('auth.register');
    Route::post('login', ['middleware' => 'guest', 'uses' => 'AuthController@login'])->name('auth.login');
    Route::post('logout', ['middleware' => 'auth:sanctum', 'uses' => 'AuthController@logout'])->name('auth.logout');
});

Route::group(['prefix' => 'profile', 'middleware' => 'auth:sanctum'], function () {
    Route::get('', 'ProfileController@index')->name('profile.index');
});

Route::group(['prefix' => 'post', 'middleware' => 'auth:sanctum'], function () {
    Route::get('', 'PostController@index')->name('post.index');
    Route::get('{id}', 'PostController@show')->name('post.show')->where('id', '[0-9]+');
    Route::post('', 'PostController@create')->name('post.create');
    Route::patch('{id}', 'PostController@update')->name('post.update')->where('id', '[0-9]+');
    Route::delete('{id}', 'PostController@destroy')->name('post.destroy')->where('id', '[0-9]+');
});
