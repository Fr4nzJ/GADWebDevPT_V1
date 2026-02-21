<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /** @use HasFactory<\Database\Factories\ReportFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'year',
        'type',
        'file_path',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
        ];
    }
}
