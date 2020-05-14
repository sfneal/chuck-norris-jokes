<?php

namespace Sfneal\ChuckNorrisJokes;

class JokeFactory
{
    /**
     * @var array
     */
    private $jokes = [
        'The First rule of Chuck Norris is: you do not talk about Chuck Norris.',
        'Chuck Norris does not wear a condom. Because there is no such thing as protection from Chuck Norris.',
        "Chuck Norris' tears cure cancer. Too bad he has never cried.",
        'Chuck Norris counted to infinity... Twice.',
    ];

    public function __construct(array $jokes = null)
    {
        $this->jokes = $jokes ?? $this->jokes;
    }

    public function getRandomJoke()
    {
        return $this->jokes[array_rand($this->jokes)];
    }
}
