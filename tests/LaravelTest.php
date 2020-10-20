<?php

namespace Sfneal\ChuckNorrisJokes\Tests;

use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;
use Sfneal\ChuckNorrisJokes\ChuckNorrisJokesServiceProvider;
use Sfneal\ChuckNorrisJokes\Console\ChuckNorrisJoke;
use Sfneal\ChuckNorrisJokes\Facades\ChuckNorris;

class LaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ChuckNorrisJokesServiceProvider::class;
    }

    protected function getPackageAliases($app)
    {
        return [
            'ChuckNorris' => ChuckNorrisJoke::class,
        ];
    }

    /** @test */
    public function test_the_console_command_return_a_joke()
    {
        // Dont output artisan command
        $this->withoutMockingConsoleOutput();

        // Facade should return 'some joke' instead of an actual random joke
        ChuckNorris::shouldReceive('getRandomJoke')
            ->once()
            ->andReturn('some joke');

        // Call artisan command
        $this->artisan('chuck-norris');

        // Retrieve command output
        $output = Artisan::output();

        // Assert command output is 'some joke'
        $this->assertSame('some joke'.PHP_EOL, $output);
    }

    /** @test */
    public function the_route_can_be_accessed()
    {
        // Facade should return 'some joke' instead of an actual random joke
        ChuckNorris::shouldReceive('getRandomJoke')
            ->once()
            ->andReturn('some joke');

        $this->get('/chuck-norris')
            ->assertStatus(200);
    }
}
