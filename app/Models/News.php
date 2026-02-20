<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'category',
        'author',
        'status',
        'images',
        'views',
    ];

    protected $casts = [
        'images' => 'array',
        'views' => 'integer',
    ];

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'published' => '#48c774',
            'draft' => '#999',
            'pending' => '#f0ad4e',
            'archived' => '#ddd',
        ];
        return $colors[$this->status] ?? '#999';
    }
}
