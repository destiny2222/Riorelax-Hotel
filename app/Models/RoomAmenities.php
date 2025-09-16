<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomAmenities extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'room_listing_id',
    ];

    public function roomListing()
    {
        return $this->belongsTo(RoomListing::class);
    }
}
