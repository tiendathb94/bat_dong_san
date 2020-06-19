<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('default.layouts.default');
})->name('home');

Route::get('/dang-ky-tai-khoan', 'AuthController@registerForm')->name('registerForm');
Route::post('/dang-ky-tai-khoan', 'AuthController@registerStore')->name('registerStore');

Route::get('/dang-nhap', 'AuthController@loginForm')->name('loginForm');
Route::post('/dang-nhap', 'AuthController@loginStore')->name('loginStore');

Route::get('/dang-xuat', 'AuthController@logout')->name('logout');

Route::get('/mail', 'AuthController@confirm')->name('confirm');
