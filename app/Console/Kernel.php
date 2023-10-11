<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command('backup:run --only-db')->daily()->at("23:59")
        ->onSuccess(function(){
            Log::info("DB Backup Success");
        })->onFailure(function(){
            Log::error("DB Backup Failed");
        });

        $schedule->command('app:send-task-timeline-email')->daily()->at("00:30")
        ->onSuccess(function(){
            Log::info("Berhasil Menjalankan schedular Mailer Reminder Task Project");
        })->onFailure(function(){
            Log::error("Gagal Menjalankan schedular Mailer Reminder Task Project");
        });

        $schedule->command('app:send-task-timeline-email')->daily()->at("09:30")
        ->onSuccess(function(){
            Log::info("Berhasil Menjalankan schedular Mailer Reminder Task Project");
        })->onFailure(function(){
            Log::error("Gagal Menjalankan schedular Mailer Reminder Task Project");
        });

        $schedule->command('app:send-task-timeline-email')->daily()->at("15:30")
        ->onSuccess(function(){
            Log::info("Berhasil Menjalankan schedular Mailer Reminder Task Project");
        })->onFailure(function(){
            Log::error("Gagal Menjalankan schedular Mailer Reminder Task Project");
        });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
