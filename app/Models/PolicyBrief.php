<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyBrief extends Model
{
    protected $fillable = [
        'title',
        'description',
        'pages',
        'year',
        'icon',
        'color',
        'page',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'pages' => 'integer',
        'order' => 'integer',
    ];
}
