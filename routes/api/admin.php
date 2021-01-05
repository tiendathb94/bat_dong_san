<?php

Route::group(['prefix' => 'admin'], function () {
    Route::get('{id}/change-active', 'Api\AdminController@changeActive')->name('admin.change_active');
});
