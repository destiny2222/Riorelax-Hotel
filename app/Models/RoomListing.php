<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class RoomListing extends Model
{
    public $fillable = ['room_type', 'price','slug', 'description', 'room_title', 'room_image', 'room_images', 'room_number', 'is_available', 'availability_status'];

    public function amenities(){
        return $this->hasMany(RoomAmenities::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // public function getSlugAttribute(): string
    // {
    //     return Str::slug($this->room_title);
    // }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('room_title')
            ->saveSlugsTo('slug');
    }

    protected $casts = [
        'room_images' => 'array'
    ];

}
