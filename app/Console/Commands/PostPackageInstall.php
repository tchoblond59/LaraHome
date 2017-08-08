<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Plugin;

class PostPackageInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package_event:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post install event package';

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
        $plugin = Plugin::orderBy('updated_at', 'DESC')->first();
        $plugin->enable = 1;
        $plugin->save();
    }
}
