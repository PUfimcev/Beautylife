<?php
// Handle a schedule for deletind of expired offers

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Offer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveOffer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-offer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Offer delete';

    /**
    * Create a new command instance.
    *
    * @return void
    */
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $local_timezone = session()->get('timezone');

        $currentTime  = Carbon::now()->setTimezone($local_timezone);

        DB::table('offers')->where('period_to', '<', $currentTime)->delete();

    }
}

