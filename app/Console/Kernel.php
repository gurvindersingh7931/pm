<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Task;
use Carbon\Carbon;
use App\Notifications\DeadlinePassed;
use App\Notifications\DeadlineArriving;
use Illuminate\Support\Facades\Notification;


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
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            $tasks = Task::where('target', '<', Carbon::now()->toDateTimeString())->get();
            if(count($tasks) > 0) {
                foreach($tasks as $task) {
                    Notification::send($task->project->user, new DeadlinePassed($task));
                }
            }
        })->daily();
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
}
