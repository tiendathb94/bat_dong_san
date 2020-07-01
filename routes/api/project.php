<?php

Route::group(['guard' => 'api', 'middleware' => ['auth:api']], function () {
    Route::post('/project/create', 'Api\ProjectController@createProject')->name('api.project.create');
    Route::delete('/project/{projectId}', 'Api\ProjectController@deleteProject')->name('pages.project.delete_project');
    Route::put('/project/{projectId}', 'Api\ProjectController@updateProject')->name('pages.project.update_project');
    Route::post('/project/{projectId}/{action}', 'Api\ProjectController@updateProjectStatus')->name('pages.project.updateProjectStatus');
});

Route::get('/project/search', 'Api\ProjectController@searchByName');
