<?php

Route::get('/tin-tuc', 'Web\NewsController@create')->name('news.create');

Route::post('/tin-tuc', 'Web\NewsController@store')->name('news.store');