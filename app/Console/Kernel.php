<?php

namespace App\Console;

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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // update every hour and 15 minutes
        $this->runEveryHourAndFifteenMinutes($schedule, 'aio:update-characters');
        $this->runEveryHourAndFifteenMinutes($schedule, 'aio:update-alliances', 5);
        $this->runEveryHourAndFifteenMinutes($schedule, 'aio:update-corporations', 10);
        $this->runEveryHourAndFifteenMinutes($schedule, 'aio:update-all-corporation-assets'. 12);
        $schedule->command('update:character-stats')->daily();
        $schedule->command('aio:update-notifications')->everyTenMinutes();
        $schedule->command('aio:update-corporation-industry-jobs')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    private function runEveryHourAndFifteenMinutes(Schedule $schedule, string $command, int $offset = 0) {
        $schedule->command($command)->cron(0 + $offset . ' 0,4,8,12,16,20 * * *');
        $schedule->command($command)->cron(15 + $offset . ' 1,5,9,13,17,21 * * *');
        $schedule->command($command)->cron(30 + $offset . ' 2,6,10,14,18,22 * * *');
        $schedule->command($command)->cron(45 + $offset . ' 3,7,11,15,19,23 * * *');
    }
}
