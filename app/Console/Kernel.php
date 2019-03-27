<?php

namespace App\Console;

use App\Command;
use App\Console\Commands\PlayCommand;
use App\Console\Commands\PlayScenario;
use App\Scenario;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Schema;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\PlayCommand::class,
        Commands\PlayScenario::class,
        Commands\LarahomeCommand::class,
        Commands\PostPackageInstall::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        \Log::info('Schedule call');
        if(Schema::table('commands')->hasColumn('cron'))
        {
            foreach (\App\Command::whereNotNull('cron')->get() as $command)
            {
                $schedule->command(PlayCommand::class, [$command->id])->cron($command->cron)->withoutOverlapping();
            }
        }
        if(Schema::table('scenarios')->hasColumn('cron'))
        {
            foreach (Scenario::whereNotNull('cron')->get() as $scenario)
            {
                $schedule->command(PlayScenario::class, [$scenario->id])->cron($scenario->cron)->withoutOverlapping();
            }
        }
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
        $this->load(__DIR__.'/Commands');
    }
}
