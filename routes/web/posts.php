<?php 

Route::group(['as' => 'posts.'], function () {
    Route::get('dang-tin-rao-vat-ban-nha-dat', 'Web\PostController@createSell')
        ->defaults('_config', ['view' => 'default.pages.posts.create_sell'])
        ->name('create_sell');
    Route::get('quan-ly-tin-rao-vat-ban-nha-dat', 'Web\PostController@listSell')
        ->defaults('_config', ['view' => 'default.pages.posts.list_sell'])
        ->name('list_sell');
    Route::get('dang-tin-rao-vat-mua-nha-dat', 'Web\PostController@createBuy')
        ->defaults('_config', ['view' => 'default.pages.posts.create_buy'])
        ->name('create_buy');
    Route::get('quan-ly-tin-rao-vat-mua-nha-dat', 'Web\PostController@listBuy')
        ->defaults('_config', ['view' => 'default.pages.posts.list_buy'])
        ->name('list_buy');
    Route::post('create-post', 'Web\PostController@store')
        ->defaults('_config', ['view' => 'default.pages.posts.store'])
        ->name('store');
    Route::prefix('get')->name('get.')->group(function () {
        Route::post('district','Web\PostController@getDistrict')->name('district');
        Route::post('ward','Web\PostController@getWard')->name('ward');
    });
});
