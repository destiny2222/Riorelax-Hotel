<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'image',
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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role');
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        // Check the role column first (primary method)
        if (!empty($this->role)) {
            return strtolower($this->role) === strtolower($role);
        }
        
        // Fallback to relationship-based check if role column is empty
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * Check if user has any of the given roles
     *
     * @param array $roles
     * @return bool
     */
    public function hasAnyRole(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if user is super admin
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }

    /**
     * Check if user is supervisor
     *
     * @return bool
     */
    public function isSupervisor(): bool
    {
        return $this->hasRole('supervisor');
    }

    /**
     * Check if user is front desk
     *
     * @return bool
     */
    public function isFrontDesk(): bool
    {
        return $this->hasRole('front-desk');
    }

    /**
     * Check if user can approve booking edits
     *
     * @return bool
     */
    public function canApproveBookingEdits(): bool
    {
        return $this->isSuperAdmin() || $this->isSupervisor();
    }

    /**
     * Check if user can edit rooms
     *
     * @return bool
     */
    public function canEditRooms(): bool
    {
        return $this->isSuperAdmin();
    }

    /**
     * Check if user can delete bookings
     *
     * @return bool
     */
    public function canDeleteBookings(): bool
    {
        return $this->isSuperAdmin();
    }

    /**
     * Check if user can export customer list
     *
     * @return bool
     */
    public function canExportCustomers(): bool
    {
        return $this->isSuperAdmin();
    }

    /**
     * Check if user can directly edit sensitive booking fields
     *
     * @return bool
     */
    public function canDirectlyEditSensitiveFields(): bool
    {
        return $this->isSuperAdmin() || $this->isSupervisor();
    }

    /**
     * Check if user can update room status
     *
     * @return bool
     */
    public function canUpdateRoomStatus(): bool
    {
        return $this->isSuperAdmin() || $this->isSupervisor();
    }

    /**
     * Get edit requests initiated by this admin
     */
    public function initiatedEditRequests()
    {
        return $this->hasMany(BookingEditRequest::class, 'requested_by');
    }

    /**
     * Get edit requests approved by this admin
     */
    public function approvedEditRequests()
    {
        return $this->hasMany(BookingEditRequest::class, 'approved_by');
    }

    public function hasPermissionTo($permissionName)
    {
        return $this->roles()->whereHas('permissions', function ($query) use ($permissionName) {
            $query->where('name', $permissionName);
        })->exists();
    }
}
