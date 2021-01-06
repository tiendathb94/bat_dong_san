<?php

Route::get('/', 'Web\HomeController@index')->defaults('_config', [
    'view' => 'home'
])->name('home');
