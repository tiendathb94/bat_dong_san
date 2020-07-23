<?php

Route::group(['prefix' => 'posts'], function () {
    Route::get('price-unit', 'Api\PostController@getPriceUnit');
    Route::get('direction', 'Api\PostController@getDirection');
});
