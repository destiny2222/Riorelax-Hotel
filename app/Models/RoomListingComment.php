<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomListingComment extends Model
{
    public $fillable = [
        'room_listing_id',
        'user_id',
        'comment',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roomListing()
    {
        return $this->belongsTo(RoomListing::class);
    }

    // public function rating ()
    // {
    //     return $this->rating;
    // }

}
