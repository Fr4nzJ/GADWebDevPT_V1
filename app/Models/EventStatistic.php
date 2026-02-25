<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventStatistic extends Model
{
    protected $fillable = [
        'label',
        'value',
        'icon',
        'color',
        'page',
        'order',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
