<?php

namespace Sfneal\ChuckNorrisJokes\Tests;

use PHPUnit\Framework\TestCase;
use Sfneal\ChuckNorrisJokes\JokeFactory;

class JokeFactoryTest extends TestCase
{
    public function test_it_returns_a_random_joke()
    {
        $jokes = new JokeFactory([
            'This is a joke',
        ]);
        $joke = $jokes->getRandomJoke();

        $this->assertSame('This is a joke', $joke);
    }

    public function test_it_returns_a_predefined_joke()
    {
        $chuckNorrisJokes = [
            'The First rule of Chuck Norris is: you do not talk about Chuck Norris.',
            'Chuck Norris does not wear a condom. Because there is no such thing as protection from Chuck Norris.',
            "Chuck Norris' tears cure cancer. Too bad he has never cried.",
            'Chuck Norris counted to infinity... Twice.',
        ];

        $jokes = new JokeFactory();
        $joke = $jokes->getRandomJoke();

        $this->assertContains($joke, $chuckNorrisJokes);
    }
}
