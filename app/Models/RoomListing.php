<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RoomListing extends Model
{
    public $fillable = ['room_type', 'price','slug', 'description', 'room_title', 'room_image', 'room_images', 'room_number', 'is_available'];

    public function amenities(){
        return $this->hasMany(RoomAmenities::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->room_title);
    }

    protected $casts = [
        'room_images' => 'array'
    ];

}
