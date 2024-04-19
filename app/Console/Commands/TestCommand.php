<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test:command';

    protected $description = 'This is a test command';

    public function handle()
    {
        $this->info('Test command executed successfully!');
    }
}
