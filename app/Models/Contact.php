<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'reply_message',
        'replied_at',
        'replied_by',
        'status',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'replied_at' => 'datetime',
    ];

    /**
     * Get the user who replied to this contact.
     */
    public function repliedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'replied_by');
    }
}
