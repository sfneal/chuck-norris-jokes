<?php

namespace Sfneal\ChuckNorrisJokes\Console;

use Illuminate\Console\Command;
use Sfneal\ChuckNorrisJokes\Facades\ChuckNorris;

class ChuckNorrisJoke extends Command
{
    /**
     * @var string Signature used to call command is called from a CLI
     */
    protected $signature = 'chuck-norris';

    /**
     * @var string Description of the command
     */
    protected $description = 'Output a funny Chuck Norris Joke';

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info(ChuckNorris::getRandomJoke());
    }
}
