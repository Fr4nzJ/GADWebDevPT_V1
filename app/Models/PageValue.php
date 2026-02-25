<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', // 'objective', 'value', 'mandate', 'goal', 'vision', 'mission'
        'content',
        'page',
        'order',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
