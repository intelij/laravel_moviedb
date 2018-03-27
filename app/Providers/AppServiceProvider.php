<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\User;
use App\Genre;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Cashier::useCurrency('eur','€');

        Blade::if('subscriber',function () {

            return User::subscriber();

        });

        Blade::if('author',function () {

            return User::author();

        });

        Blade::if('editor', function () {

            return User::editor();

        });

        Blade::if('admin', function () {

            return User::admin();

        });

        view()->composer('layouts.sidebar',function($view) {

            $genres = Genre::all();

            $view->with(compact('genres'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
