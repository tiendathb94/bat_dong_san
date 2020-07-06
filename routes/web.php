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
$routes = scandir(base_path('routes/web'));

Route::get('/', function () {
    return view('default.layouts.default');
})->name('home');

Route::get('/mail', 'AuthController@confirm')->name('confirm');
foreach($routes as $route) {
    if (!in_array($route, ['.', '..'])) {
        require_once(base_path("routes/web/$route"));
    }
}



