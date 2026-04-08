<?php

namespace App\Providers;

use App\Models\Apprenantannee;
use App\Observers\DecisionAutoObserver;
use App\Observers\ApprenantanneeObserver;
use Illuminate\Support\ServiceProvider;

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
        Apprenantannee::observe(ApprenantanneeObserver::class);
    }
}
