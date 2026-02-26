<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardStatistic extends Model
{
    protected $fillable = [
        'label',
        'value',
        'icon_class',
        'color_class',
        'trend_value',
        'trend_direction',
        'trend_text',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'integer',
            'trend_value' => 'integer',
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
