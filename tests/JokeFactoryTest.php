<?php

namespace Sfneal\ChuckNorrisJokes\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Sfneal\ChuckNorrisJokes\JokeFactory;

class JokeFactoryTest extends TestCase
{
    public function test_it_returns_a_random_joke()
    {
        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], '{ "type": "success", "value": { "id": 526, "joke": "No one has ever pair-programmed with Chuck Norris and lived to tell about it.", "categories": ["nerdy"] } }'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $jokes = new JokeFactory($client);

        $joke = $jokes->getRandomJoke();

        $this->assertSame('No one has ever pair-programmed with Chuck Norris and lived to tell about it.', $joke);
    }
}
