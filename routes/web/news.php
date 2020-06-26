<?php

Route::group(['guard' => 'web', 'middleware' => ['auth']], function () {
    Route::group(['middleware' => ['permission']], function () {
        Route::get('/tin-tuc', 'Web\NewsController@create')->name('news.create');

        Route::post('/tin-tuc', 'Web\NewsController@store')->name('news.store');
    });

    Route::delete('news/{id}', 'Web\NewsController@destroy')->name('pages.news.destroy');
});
