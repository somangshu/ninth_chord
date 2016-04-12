<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Genre\GenreRepository',
            'App\Repositories\Genre\GenreRepositoryEloquent'
        );

        $this->app->bind(
            'App\Repositories\Track\TrackRepository',
            'App\Repositories\Track\TrackRepositoryEloquent'
        );
    }
}
