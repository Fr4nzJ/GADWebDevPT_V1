<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'status',
        'images',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'images' => 'array',
    ];

    /**
     * Get the first image or a placeholder
     */
    public function getFirstImageAttribute(): ?string
    {
        if (!empty($this->images) && is_array($this->images)) {
            return $this->images[0];
        }
        return null;
    }

    /**
     * Get all images with full paths
     */
    public function getImagesWithPathsAttribute(): array
    {
        if (empty($this->images)) {
            return [];
        }
        
        return array_map(function ($image) {
            return asset('storage/' . $image);
        }, $this->images);
    }
}