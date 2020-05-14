<?php

namespace Sfneal\ChuckNorrisJokes;

use GuzzleHttp\Client;

class JokeFactory
{
    /**
     * Chuck Norris Jokes api endpoint
     */
    private const API_ENDPOINT = 'https://api.icndb.com/jokes/random';

    /**
     * @var Client|null
     */
    protected $client;

    /**
     * JokeFactory constructor.
     *
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function getRandomJoke()
    {
        $response = $this->client->get(self::API_ENDPOINT);

        $joke = json_decode($response->getBody()->getContents());
        return $joke->value->joke;
    }
}
