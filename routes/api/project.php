<?php

Route::group(['guard' => 'api', 'middleware' => ['auth:api']], function () {
    Route::post('/project/create', 'Api\ProjectController@createProject')->name('api.project.create');

});

Route::get('/project/search', 'Api\ProjectController@searchByName');
