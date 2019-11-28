<?php

use Illuminate\Routing\Router;

Route::post('/register', 'Auth\RegisterController@create');
Route::get('/messages', 'MessagesController@index')->name('messages.index');
Route::post('/messages', 'MessagesController@store')->name('messages.store');
Route::post('/login', 'Auth\WebAuthController@login')->name('login')->middleware('guest');
Route::post('/logout', 'Auth\WebAuthController@logout')->name('logout')->middleware('auth');

Route::get('/{any}', function () {
    return view('spa-entry-point');
})->where('any', '.*');

