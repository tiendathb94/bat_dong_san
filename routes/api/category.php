<?php

Route::group(['guard' => 'api'], function () {
    Route::get('/category/by-destination-entity', 'Api\CategoryController@getCategoriesByDestinationEntity')->name('api.category.by_destination_entity');

    Route::get('/category/search', 'Api\CategoryController@searchByName');
});
