<?php

namespace Sfneal\ChuckNorrisJokes\Http\Controllers;

use Sfneal\ChuckNorrisJokes\Facades\ChuckNorris;

class ChuckNorrisController
{
    /**
     * Retrieve a random joke.
     *
     * @return string
     */
    public function __invoke()
    {
        return ChuckNorris::getRandomJoke();
    }
}
