<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PlayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:play {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'play command by id';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $command_id = $this->argument('id');
        $command = \App\Command::findOrFail($command_id);
        $command->play();
        return 0;
    }
}
