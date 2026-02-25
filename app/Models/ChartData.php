<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChartData extends Model
{
    protected $table = 'chart_data';

    protected $fillable = [
        'chart_type',
        'label',
        'value',
        'page',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'value' => 'integer',
    ];
}
