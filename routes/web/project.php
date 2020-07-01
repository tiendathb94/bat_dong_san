<?php

Route::group(['guard' => 'web', 'middleware' => ['auth', 'permission']], function () {
    Route::get('/project/create', 'Web\ProjectController@create')
        ->defaults('_config', [
            'view' => 'default.pages.project.create'
        ])
        ->name('pages.project.create');

    Route::get('/project/update/{projectId}', 'Web\ProjectController@update')
        ->defaults('_config', [
            'view' => 'default.pages.project.update'
        ])
        ->name('pages.project.update');

    Route::get('/project/posted', 'Web\ProjectController@managePostedProject')
        ->defaults('_config', [
            'view' => 'default.pages.project.show_posted'
        ])
        ->name('pages.project.show_posted');

    Route::get('/project/awaiting-review', 'Web\ProjectController@manageAwaitingReviewProject')
        ->defaults('_config', [
            'view' => 'default.pages.project.awaiting_review'
        ])
        ->name('pages.project.awaiting_review');
});
