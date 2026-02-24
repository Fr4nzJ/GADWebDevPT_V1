<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'verification_code',
        'is_verified',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];
}
