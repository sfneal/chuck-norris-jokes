<?php

namespace Sfneal\ChuckNorrisJokes;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Sfneal\ChuckNorrisJokes\Console\ChuckNorrisJoke;
use Sfneal\ChuckNorrisJokes\Http\Controllers\ChuckNorrisController;

class ChuckNorrisJokesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Declare commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                ChuckNorrisJoke::class,
            ]);
        }

        // Load Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'chuck-norris');

        // Publish Views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/chuck-norris'),
        ], 'views');

        // Publish config file
        $this->publishes([
            __DIR__.'/../config/chuck-norris.php' => base_path('config/chuck-norris.php'),
        ], 'config');

        // Declare Routes
        Route::get(config('chuck-norris.route'), ChuckNorrisController::class);
    }

    public function register()
    {
        // Register service provider in Laravel IoC container
        $this->app->bind('chuck-norris', function () {
            return new JokeFactory();
        });

        // Load config file
        $this->mergeConfigFrom(__DIR__.'/../config/chuck-norris.php', 'chuck-norris');
    }
}
