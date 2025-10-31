<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyAndFriend extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'added_by',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }
}
