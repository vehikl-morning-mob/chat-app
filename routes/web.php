<?php

Route::get('/{any}', function () {
    return view('spa-entry-point');
})->where('any', '.*');

Route::post('/register', 'Auth\RegisterController@create');
