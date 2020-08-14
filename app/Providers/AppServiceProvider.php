<?php

namespace App\Providers;

use App\Entities\ImageLibrary;
use App\Observers\ImageLibraryObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {    
        Schema::defaultStringLength(191);
        ImageLibrary::observe(ImageLibraryObserver::class);
    }
}
