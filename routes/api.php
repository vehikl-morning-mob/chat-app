<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->prefix('auth')->group(function () {
    Route::post('login', 'ApiAuthController@login')->name('api.login');
    Route::post('refresh', 'ApiAuthController@refresh')->middleware('auth:api')->name('api.refresh');
});

Route::middleware('api')->group(function () {
    Route::get('messages', 'MessagesController@index')->name('api.messages.index');
    Route::post('messages', 'MessagesController@store')->name('api.messages.store');
});

// Soft deletes
// "deleted_at"
//  2019-08-20 12:12:34

// RESTful API
// GET - Retreive information
// PUT/PATCH - Modify existing information
// DELETE - Remove
// POST - Insert new information

