<?php

Route::post('/register', 'Auth\RegisterController@create');
Route::get('/messages', 'MessagesController@index')->name('messages.index');
Route::post('/messages', 'MessagesController@store')->name('messages.store');

Route::get('/{any}', function () {
    return view('spa-entry-point');
})->where('any', '.*');

