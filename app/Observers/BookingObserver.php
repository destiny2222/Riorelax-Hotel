<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class BookingObserver
{
    /**
     * Handle the Booking "updated" event.
     * Credit wallet points when booking status changes to 'checked-out'
     */
    public function updated(Booking $booking)
    {
        // Check if status was changed to 'checked-out'
        if ($booking->isDirty('status') && $booking->status === 'checked-out') {
            $originalStatus = $booking->getOriginal('status');
            
            // Only credit if the previous status was not 'checked-out'
            if ($originalStatus !== 'checked-out') {
                try {
                    $booking->creditWalletPoints();
                    Log::info("Wallet points credited for booking {$booking->id} after checkout");
                } catch (\Exception $e) {
                    Log::error("Failed to credit wallet points for booking {$booking->id}: " . $e->getMessage());
                }
            }
        }
    }
}