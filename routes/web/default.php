<?php

Route::get('/', function () {
    return view('default.layouts.default');
})->name('home');
