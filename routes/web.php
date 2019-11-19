<?php

Auth::routes();

Route::get('/{any}', function() {
    return view('home');
})->where('any', '.*')->name('login');

