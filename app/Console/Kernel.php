<?php

namespace App\Console;

use App\Console\Commands\Generators\AdminControllerGenerator;
use App\Console\Commands\Generators\AdminRequestGenerator;
use App\Console\Commands\Generators\AdminServiceGenerator;
use App\Console\Commands\Generators\ApiControllerGenerator;
use App\Console\Commands\Generators\ApiRequestGenerator;
use App\Console\Commands\Generators\ModelGenerator;
use App\Console\Commands\Generators\ServiceGenerator;
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
        ModelGenerator::class,
        ServiceGenerator::class,
        ApiControllerGenerator::class,
        ApiRequestGenerator::class,
        AdminControllerGenerator::class,
        AdminRequestGenerator::class,
        AdminServiceGenerator::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
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

