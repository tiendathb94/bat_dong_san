<?php

Route::group(['guard' => 'web', 'middleware' => ['auth', 'permission']], function () {
    Route::get('/tin-tuc', 'Web\NewsController@create')->name('news.create');

    Route::post('/tin-tuc', 'Web\NewsController@store')->name('news.store');

    Route::delete('news/{id}', 'Web\NewsController@destroy')->name('pages.news.destroy');
});
