<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticalYearbook extends Model
{
    protected $fillable = [
        'title',
        'description',
        'publication_date',
        'pages',
        'format',
        'languages',
        'file_path',
        'download_size',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'publication_date' => 'date',
            'pages' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
