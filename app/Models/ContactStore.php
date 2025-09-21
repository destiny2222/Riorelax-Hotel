<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactStore extends Model
{
    public $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'subject',
        'message',
    ];
}
