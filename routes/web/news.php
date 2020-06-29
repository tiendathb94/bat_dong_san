<?php


Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');


    
Route::group(['guard' => 'web', 'prefix' => 'tin-tuc', 'middleware' => ['auth']], function () {
    Route::group(['middleware' => ['permission']], function () {
        Route::get('dang-tin', 'Web\NewsController@create')->name('news.create');

        Route::get('u/{slug}', 'Web\NewsController@update')->name('news.update');

        Route::post('u/{slug}', 'Web\NewsController@postUpdate')->name('news.postUpdate');

        Route::post('dang-tin', 'Web\NewsController@store')->name('news.store');

        Route::patch('{id}', 'Web\NewsController@updateStatus')->name('news.update_status');
    });

    Route::delete('{id}', 'Web\NewsController@destroy')->name('news.destroy');
});
