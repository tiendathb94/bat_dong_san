<?php

Route::group(['guard' => 'web', 'prefix' => 'tin-tuc', 'middleware' => ['auth']], function () {
    Route::group(['middleware' => ['permission']], function () {
        Route::get('', 'Web\NewsController@create')->name('news.create');

        Route::post('', 'Web\NewsController@store')->name('news.store');

        Route::patch('{id}', 'Web\NewsController@updateStatus')->name('news.update_status');
    });

    Route::delete('{id}', 'Web\NewsController@destroy')->name('news.destroy');
});
