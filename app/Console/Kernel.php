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

        // command schedule for deleting of expired offers

        // $schedule->command('app:remove-offer')->everyMinute();

        // Or such a way

        $schedule->call(function () {
            $local_timezone = session()->get('timezone');

            $currentTime  = Carbon::now()->setTimezone($local_timezone);

            foreach(Offer::all()->where('period_to', '<', $currentTime) as $offer){
                $offer->delete();
            }

        })->daily();
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
