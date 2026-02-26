<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardActivity extends Model
{
    protected $fillable = [
        'user_name',
        'action',
        'module',
        'description',
        'status',
        'action_time',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'action_time' => 'datetime',
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
