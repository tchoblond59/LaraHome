<?php

namespace App\Console\Commands;

use App\Scenario;
use Illuminate\Console\Command;

class PlayScenario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scenario:play {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Play scenario by id if enable';

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
        $id = $this->argument('id');
        $scenario = Scenario::findOrFail($id);
        $scenario->play();
    }
}
