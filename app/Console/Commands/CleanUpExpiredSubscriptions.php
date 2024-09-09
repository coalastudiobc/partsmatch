<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Import Log facade


class CleanUpExpiredSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        // $expiredSubscriptions = DB::table('subscriptions')
        //     ->where('ends_at', '<', $now)
        //     ->get();

        //     foreach ($expiredSubscriptions as $subscription) {
        //         // Remove the user's products from the feature table
        //         DB::table('FeaturedProduct')
        //             ->where('user_id', $subscription->user_id)
        //             ->delete();
        //     }
    
        //     $this->info('Expired subscriptions have been cleaned up.');
        //     $now = Carbon::now();
    
            try {
                $expiredSubscriptions = DB::table('subscriptions')
                    ->where('ends_at', '<', $now)
                    ->pluck('user_id', 'id');
        
                // Use a transaction to ensure data consistency
                DB::transaction(function () use ($expiredSubscriptions) {
                    foreach ($expiredSubscriptions as $subscriptionId => $userId) {
                        try {
                            DB::table('featured_products')->where('user_id', $userId)->delete();
                        } catch (\Exception $e)
                        {
                            Log::error('Failed to clean up user_id ' . $userId . ': ' . $e->getMessage());
                        }
                    }
                });
        
                $this->info('Expired subscriptions have been cleaned up.');
            } catch (\Exception $e) {
                Log::error('Failed to clean up expired subscriptions: ' . $e->getMessage());
            }
    }
}
