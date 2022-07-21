<?php

namespace App\Console;

use App\Console\Commands\GetGenresCommand;
use App\Console\Commands\GetPopularCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        GetGenresCommand::class,
        GetPopularCommand::class
    ];


    protected function schedule(Schedule $schedule)
    {
        $schedule->command('get:genres');
        $schedule->command('get:populars')->withoutOverlapping;
        // run command py php artisan schedule:run

        /*
        // register your command in schedule
        GetGenresCommand::class;
        GetPopularCommand::class;
        */

    }


    protected function commands()
    {

        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
