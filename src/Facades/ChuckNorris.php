<?php

namespace Sfneal\ChuckNorrisJokes\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getRandomJoke()
 */
class ChuckNorris extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'chuck-norris';
    }
}
