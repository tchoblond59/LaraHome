<?php

namespace App\Console;

use App\Console\Commands\SendMSCommands;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\ScheduledMSCommands;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendMSCommands::class,
        Commands\PostPackageInstall::class,
        Commands\LarahomeCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if(\Schema::hasTable('scheduled_mscommands') && \Schema::hasTable('scenario_mscommands') && \Schema::hasTable('plugins'))
        {
            foreach (ScheduledMSCommands::all() as $command) {
                $schedule->command(SendMSCommands::class, [$command->mscommand->id])->cron($command->cron);
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
    }
}
