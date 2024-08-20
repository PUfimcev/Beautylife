<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Offer;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
          // artisan command method

        $schedule->command('app:remove-offer')->everyMinute();

        // $schedule->call(function () {
        //     $local_timezone = session()->get('timezone');

        //     $currentTime  = Carbon::now()->setTimezone($local_timezone);

        //     foreach(Offer::all()->where('period_to', '<', $currentTime) as $offer){
        //         $offer->delete();
        //     }

        // })->everyMinute();

        // /Applications/XAMPP/xamppfiles/htdocs/Beautylife

        // /Applications/XAMPP/xamppfiles/htdocs/Beautylife/app/Console/Kernel.php
        // http://localhost/Beautylife/public/


        // /opt/homebrew/Cellar/php/8.2.3/bin/php

        //


        // * * * * * cd /Applications/XAMPP/xamppfiles/htdocs/Beautylife &&  php artisan schedule:run  >> /dev/null 2>&1

        // /Applications/XAMPP/xamppfiles/htdocs

        // /etc/crontab


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
