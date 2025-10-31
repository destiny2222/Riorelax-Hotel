<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'address',
        'city',
        'wallets',
        'wallet_points',
        'state',
        'country',
        'dob',
        'zip',
        'email',
        'password',
        'profile_image'
    ];


    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is in family and friends list
     */
    public function isInFamilyAndFriends()
    {
        return FamilyAndFriend::where(function($query) {
            $query->where('email', $this->email)
                  ->orWhere('phone', $this->phone);
        })->where('is_active', true)->exists();
    }

    /**
     * Get user's discount code
     */
    public function discountCode()
    {
        return $this->hasOne(DiscountCode::class);
    }

    /**
     * Get user's bookings
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Generate discount code if eligible
     */
    public function generateDiscountCodeIfEligible()
    {
        // Check if already has a discount code
        if ($this->discountCode()->exists()) {
            return $this->discountCode;
        }

        // Check if in family and friends list
        if ($this->isInFamilyAndFriends()) {
            $code = DiscountCode::generateUniqueCode();
            
            return DiscountCode::create([
                'code' => $code,
                'user_id' => $this->id,
                'discount_percentage' => 60,
                'is_active' => true,
            ]);
        }

        return null;
    }
}

