<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;

class CancelUnpaidBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:cancel-unpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel unpaid bookings after 6 hours';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bookings = Booking::where('payment_status', 0)
            ->where('expires_at', '<', now())
            ->get();

        foreach ($bookings as $booking) {
            $booking->delete();
        }

        $this->info('Unpaid bookings have been cancelled.');
    }
}
