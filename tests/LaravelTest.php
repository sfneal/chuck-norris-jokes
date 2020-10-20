<?php

namespace Sfneal\ChuckNorrisJokes\Tests;

use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;
use Sfneal\ChuckNorrisJokes\ChuckNorrisJokesServiceProvider;
use Sfneal\ChuckNorrisJokes\Console\ChuckNorrisJoke;
use Sfneal\ChuckNorrisJokes\Facades\ChuckNorris;
use Sfneal\ChuckNorrisJokes\Models\Joke;

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

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__.'/../database/migrations/create_jokes_table.php.stub';

        (new \CreateJokesTable())->up();
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

        // Get request the route
        $this->get('/chuck-norris')
            ->assertViewIs('chuck-norris::joke')
            ->assertViewHas('joke', 'some joke')
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_access_the_database()
    {
        // Save a new Joke
        $joke = new Joke();
        $joke->joke = 'this is funny';
        $joke->save();

        // Retrieve the new Joke
        $newJoke = Joke::query()->find($joke->id);

        // Assert Jokes are the same
        $this->assertSame($newJoke->joke, 'this is funny');
    }
}
