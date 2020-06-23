<?php

Route::group(['guard' => 'api'], function () {
    Route::get('/address/provinces', 'Api\AddressController@getProvinces')->name('api.address.getProvinces');
    Route::get('/address/districts-by-province', 'Api\AddressController@getDistrictsByProvince')->name('api.address.getDistrictsByProvince');
    Route::get('/address/wards-by-district', 'Api\AddressController@getWardsByDistrict')->name('api.address.getWardsByDistrict');
});
