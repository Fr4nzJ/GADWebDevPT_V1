<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramDistributionChart extends Model
{
    protected $fillable = [
        'label',
        'value',
        'color_hex',
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
