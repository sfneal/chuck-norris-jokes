<?php

namespace Sfneal\ChuckNorrisJokes\Tests;


use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;
use Sfneal\ChuckNorrisJokes\ChuckNorrisJokesServiceProvider;
use Sfneal\ChuckNorrisJokes\Console\ChuckNorrisJoke;

class LaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ChuckNorrisJokesServiceProvider::class;
    }

    protected function getPackageAliases($app)
    {
        return [
            'ChuckNorris' => ChuckNorrisJoke::class
        ];
    }

    /** @test */
    public function the_console_command_return_a_joke()
    {
        $this->artisan('chuck-norris');

        $output = Artisan::output();

        $this->assertSame('some joke', $output);
    }
}
