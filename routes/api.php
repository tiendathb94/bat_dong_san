<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$routes = scandir(base_path('routes/api'));
foreach($routes as $route) {
    if (!in_array($route, ['.', '..'])) {
        require_once(base_path("routes/api/$route"));
    }
}
