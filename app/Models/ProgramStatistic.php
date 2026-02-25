<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStatistic extends Model
{
    protected $fillable = [
        'label',
        'value',
        'icon',
        'color',
        'background_class',
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
