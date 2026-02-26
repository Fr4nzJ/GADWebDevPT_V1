<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyEventChart extends Model
{
    protected $fillable = [
        'month',
        'value',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'integer',
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
