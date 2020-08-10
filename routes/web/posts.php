<?php 

Route::group(['as' => 'posts.'], function () {
    Route::get('dang-tin-rao-vat-ban-nha-dat', 'Web\PostController@createSell')
        ->defaults('_config', ['view' => 'default.pages.posts.create_sell'])
        ->name('create_sell');
    Route::get('quan-ly-tin-rao-vat-ban-nha-dat', 'Web\PostController@listSell')
        ->defaults('_config', ['view' => 'default.pages.posts.list_sell'])
        ->name('list_sell');
});
