<?php


Route::get('/dang-ky-tai-khoan', 'AuthController@registerForm')->name('registerForm');
Route::post('/dang-ky-tai-khoan', 'AuthController@registerStore')->name('registerStore');

Route::get('/dang-nhap', 'AuthController@loginForm')->name('loginForm');
Route::post('/dang-nhap', 'AuthController@loginStore')->name('loginStore');

Route::get('/dang-xuat', 'AuthController@logout')->name('logout');

Route::get('/confirm-mail', 'AuthController@confirm')->name('confirm');



// Route::group([ 'prefix'=>'abc', 'middleware' => ['permission', 'email'] ], function () {
// permission
// });