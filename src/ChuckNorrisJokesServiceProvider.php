<?php

namespace Sfneal\ChuckNorrisJokes;

use Illuminate\Support\ServiceProvider;
use Sfneal\ChuckNorrisJokes\Console\ChuckNorrisJoke;

class ChuckNorrisJokesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            ChuckNorrisJoke::class,
        ]);
    }

    public function register()
    {
        $this->app->bind('chuck-norris', function () {
            return new JokeFactory();
        });
    }
}
