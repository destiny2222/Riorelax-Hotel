<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingEditRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'requested_by',
        'approved_by',
        'original_data',
        'requested_changes',
        'status',
        'rejection_reason',
        'notes',
        'approved_at',
    ];

    protected $casts = [
        'original_data' => 'array',
        'requested_changes' => 'array',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the booking that this edit request belongs to
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the admin who requested the edit
     */
    public function requestedBy()
    {
        return $this->belongsTo(Admin::class, 'requested_by');
    }

    /**
     * Get the admin who approved/rejected the edit
     */
    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    /**
     * Check if the request is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the request is approved
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if the request is rejected
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if the changes require supervisor approval
     */
    public function requiresApproval()
    {
        $sensitiveFields = ['paid_amount', 'due_amount', 'check_in_date', 'check_out_date'];
        
        foreach ($sensitiveFields as $field) {
            if (isset($this->requested_changes[$field])) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Scope to get pending requests
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get approved requests
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get rejected requests
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
