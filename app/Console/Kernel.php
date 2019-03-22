<?php

namespace App\Console;

use App\Command;
use App\Console\Commands\PlayCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\PlayCommand::class,
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
        foreach (\App\Command::whereNotNull('cron')->get() as $command)
        {
            \Log::info('Schedule command '.$command->name);
            $schedule->command(PlayCommand::class, [$command->id])->cron($command->cron)->withoutOverlapping();
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
