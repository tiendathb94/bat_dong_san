<?php
Route::group(['middleware' => ['auth']], function () {
    Route::patch('update-info', 'Api\AuthController@updateInfo')->name('default.pages.auth.update_info');
    Route::get('user/information', 'Api\AuthController@information')->name('default.pages.auth.info');
});
