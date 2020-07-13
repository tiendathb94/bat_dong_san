<?php 

Route::group(['middleware' => ['auth']], function () {
    Route::group(['as' => 'posts.'], function () {
        Route::get('dang-tin-rao-vat-ban-nha-dat', 'Web\PostController@createSell')
            ->defaults('_config', ['view' => 'default.pages.posts.create_sell'])
            ->name('create_sell');
    });
});
