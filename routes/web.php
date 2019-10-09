<?php

Route::post('/register', 'Auth\RegisterController@create');
Route::get('/messages', 'MessagesController@index')->name('messages.index');
Route::get('/{any}', function () {
    return view('spa-entry-point');
})->where('any', '.*');

