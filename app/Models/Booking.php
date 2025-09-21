<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $fillable = [
        'check_in',
        'check_out',
        'adults', 
        'children',
        'rooms', 
        'room_listing_id', 
        'assign',
        'paid_amount',
        'expires_at',
        'user_id', 
        'payment_status',
        'booking_number',
        'qrcode',
        'arrival_time',
        'payment_type',
        'due_amount',
        'payment_reference',
    ];

    public function roomListing()
    {
        return $this->belongsTo(RoomListing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
