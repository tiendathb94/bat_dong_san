<?php

Route::group(['guard' => 'api', 'middleware' => ['auth']], function () {
    Route::get('/project/provinces', 'Api\AddressController@getProvinces')->name('api.address.getProvinces');
});
