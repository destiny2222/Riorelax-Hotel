<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DiscountCode extends Model
{
    protected $fillable = [
        'code',
        'user_id',
        'discount_percentage',
        'last_used_at',
        'is_active',
    ];

    protected $casts = [
        'last_used_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a unique discount code
     */
    public static function generateUniqueCode()
    {
        do {
            $code = 'FF-' . strtoupper(Str::random(8));
        } while (self::where('code', $code)->exists());

        return $code;
    }

    /**
     * Check if code can be used (once per week rule)
     */
    public function canBeUsed()
    {
        if (!$this->is_active) {
            return false;
        }

        if (!$this->last_used_at) {
            return true;
        }

        // Check if 7 days have passed since last use
        return $this->last_used_at->addDays(7)->isPast();
    }

    /**
     * Mark code as used
     */
    public function markAsUsed()
    {
        $this->last_used_at = now();
        $this->save();
    }
}
