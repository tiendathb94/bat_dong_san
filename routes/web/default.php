<?php

Route::get('/', 'Web\HomeController@index')->defaults('_config', [
    'view' => 'home'
])->name('home');
Route::get('/nha-dat-cho-thue', 'Web\HomeController@listSell')->defaults('_config', [
    'view' => 'home'
])->name('home-nha-dat-cho-thue');
Route::get('/nha-dat-ban', 'Web\HomeController@listBuy')->defaults('_config', [
    'view' => 'home'
])->name('home-nha-dat-ban');
