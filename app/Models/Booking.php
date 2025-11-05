<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $fillable = [
        'check_in_date',
        'check_out_date',
        'status',
        'adults',
        'children',
        'rooms',
        'subtotal',
        'discount_amount',
        'discount_percentage',
        'total_amount',
        'room_days',
        'room_listing_id',
        'assign',
        'paid_amount',
        'due_amount',
        'expires_at',
        'user_id',
        'payment_status',
        'booking_number',
        'qrcode',
        'arrival_time',
        'payment_type',
        'payment_reference',
        'pending_amount',
        'pending_check_in_date',
        'pending_check_out_date',
        'approval_status',
        'initiated_by_admin_id',
        'approved_by_admin_id',
        'wallet_points_earned',
        'wallet_points_used',
        'wallet_points_credited',
        'discount_code_used',
        'discount_code_amount',
    ];

    public function roomListing()
    {
        return $this->belongsTo(RoomListing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function initiatedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'initiated_by_admin_id');
    }

    public function approvedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'approved_by_admin_id');
    }

    /**
     * Get all edit requests for this booking
     */
    public function editRequests()
    {
        return $this->hasMany(BookingEditRequest::class);
    }

    /**
     * Get pending edit requests for this booking
     */
    public function pendingEditRequests()
    {
        return $this->hasMany(BookingEditRequest::class)->where('status', 'pending');
    }

    /**
     * Check if this booking has any pending edit requests
     */
    public function hasPendingEditRequest()
    {
        return $this->editRequests()->where('status', 'pending')->exists();
    }

    /**
     * Calculate the number of room-days (rooms × nights)
     */
    public function calculateRoomDays()
    {
        $checkIn = \Carbon\Carbon::parse($this->check_in_date);
        $checkOut = \Carbon\Carbon::parse($this->check_out_date);
        $nights = $checkIn->diffInDays($checkOut);
        
        return $this->rooms * $nights;
    }

    /**
     * Calculate discount based on room-days
     * 10% discount for 5 or more room-days
     */
    public function calculateDiscount($subtotal)
    {
        $roomDays = $this->calculateRoomDays();
        
        // 10% discount if 5 or more room-days
        if ($roomDays >= 5) {
            $discountPercentage = 10;
            $discountAmount = ($subtotal * $discountPercentage) / 100;
            
            return [
                'room_days' => $roomDays,
                'discount_percentage' => $discountPercentage,
                'discount_amount' => round($discountAmount, 2),
                'total_amount' => round($subtotal - $discountAmount, 2)
            ];
        }
        
        return [
            'room_days' => $roomDays,
            'discount_percentage' => 0,
            'discount_amount' => 0,
            'total_amount' => $subtotal
        ];
    }

    /**
     * Calculate booking totals with discount
     */
    public function calculateBookingTotals()
    {
        if (!$this->roomListing) {
            return null;
        }

        $pricePerNight = $this->roomListing->price;
        $checkIn = \Carbon\Carbon::parse($this->check_in_date);
        $checkOut = \Carbon\Carbon::parse($this->check_out_date);
        $nights = $checkIn->diffInDays($checkOut);
        
        // Calculate subtotal (price per night × nights × rooms)
        $subtotal = $pricePerNight * $nights * $this->rooms;
        
        // Calculate discount
        $discountData = $this->calculateDiscount($subtotal);
        
        return [
            'subtotal' => round($subtotal, 2),
            'nights' => $nights,
            'room_days' => $discountData['room_days'],
            'discount_percentage' => $discountData['discount_percentage'],
            'discount_amount' => $discountData['discount_amount'],
            'total_amount' => $discountData['total_amount']
        ];
    }

    /**
     * Check if booking qualifies for discount
     */
    public function qualifiesForDiscount()
    {
        return $this->calculateRoomDays() >= 5;
    }

    /**
     * Calculate wallet points to be earned from this booking
     * Formula: Room price ÷ 20
     * Example: A ₦25,000 room earns ₦1,250 in wallet points
     */
    public function calculateWalletPoints()
    {
        if (!$this->roomListing) {
            return 0;
        }

        $roomPrice = $this->roomListing->price;
        $walletPoints = $roomPrice / 20;
        
        return round($walletPoints, 2);
    }

    /**
     * Credit wallet points to user after checkout
     * Only credits points if booking status is 'checked-out'
     */
    public function creditWalletPoints()
    {
        // Only credit if not already credited
        if ($this->wallet_points_credited) {
            return false;
        }

        // Only credit points after checkout
        if ($this->status !== 'checked-out') {
            return false;
        }

        $pointsToCredit = $this->calculateWalletPoints();
        
        // Update user's wallet points
        $user = $this->user;
        $user->wallet_points += $pointsToCredit;
        $user->save();

        // Mark as credited
        $this->wallet_points_earned = $pointsToCredit;
        $this->wallet_points_credited = true;
        $this->save();

        return true;
    }
}
