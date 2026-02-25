<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportStatistic extends Model
{
    protected $fillable = [
        'label',
        'number',
        'subtitle',
        'icon',
        'gradient_start',
        'gradient_end',
        'page',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
