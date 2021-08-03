<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EventsEloquentRepository;
use App\Repositories\EventsRepository;

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
        //
    }
}
