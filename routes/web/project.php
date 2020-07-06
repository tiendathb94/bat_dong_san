<?php

Route::group(['guard' => 'web', 'middleware' => ['auth', 'permission']], function () {
    Route::get('/project/create', 'Web\ProjectController@create')
        ->defaults('_config', ['view' => 'default.pages.project.create'])
        ->name('pages.project.create');

    Route::get('/project/update/{projectId}', 'Web\ProjectController@update')
        ->defaults('_config', ['view' => 'default.pages.project.update'])
        ->name('pages.project.update');

    Route::get('/project/posted', 'Web\ProjectController@managePostedProject')
        ->defaults('_config', ['view' => 'default.pages.project.show_posted'])
        ->name('pages.project.show_posted');

    Route::get('/project/awaiting-review', 'Web\ProjectController@manageAwaitingReviewProject')
        ->defaults('_config', ['view' => 'default.pages.project.awaiting_review'])
        ->name('pages.project.awaiting_review');
});

// View project detail
Route::get('/du-an/{categorySlug}/{slug}', 'Web\ProjectController@showProjectDetail')
    ->defaults('_config', ['view' => 'default.pages.project.project_detail'])
    ->name('pages.project.project_detail');

// View project detail & tab
Route::get('/du-an/{categorySlug}/{slug}/{tabId}', 'Web\ProjectController@showProjectDetail')
    ->defaults('_config', ['view' => 'default.pages.project.project_detail'])
    ->name('pages.project.project_detail_tab');

Route::get('/du-an/{categorySlug}', 'Web\ProjectController@showProjectsInCategory')
    ->defaults('_config', ['view' => 'default.pages.project.show_projects_in_category'])
    ->name('pages.project.show_projects_in_category');

Route::get('/du-an-bat-dong-san', 'Web\ProjectController@projectLanding')
    ->defaults('_config', ['view' => 'default.pages.project.project_landing'])
    ->name('pages.project.project_landing');
