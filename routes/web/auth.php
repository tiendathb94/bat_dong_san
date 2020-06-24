<?php


Route::get('/dang-ky-tai-khoan', 'AuthController@registerForm')->name('registerForm');
Route::post('/dang-ky-tai-khoan', 'AuthController@registerStore')->name('registerStore');

Route::get('/dang-nhap', 'AuthController@loginForm')->name('login');
Route::post('/dang-nhap', 'AuthController@loginStore')->name('loginStore');

Route::get('/dang-xuat', 'AuthController@logout')->name('logout');

Route::get('/confirm-mail', 'AuthController@confirm')->name('confirm');

// Reset Password
Route::get('/reset-password', 'Web\AuthController@showRequestResetPasswordForm')->defaults('_config', [
    'view' => 'default.pages.auth.reset-password'
])->name('default.pages.auth.reset-password');

// Send email to reset password
Route::post('/reset-password', 'Web\AuthController@sendPasswordResetToken')
->name('default.pages.auth.reset-password');

//Reset Password
Route::get('/new-password', 'Web\AuthController@showPasswordResetForm')->defaults('_config', [
    'view' => 'default.pages.auth.new-password',
    'redirect' => 'default.pages.auth.reset-password'
])->name('default.pages.auth.new-password');

Route::post('/new-password', 'Web\AuthController@resetPassword')->defaults('_config', [
    'redirect' => 'login'
])->name('default.pages.auth.new-password');

// Route::group([ 'prefix'=>'abc', 'middleware' => ['permission', 'email'] ], function () {
// permission
// });
