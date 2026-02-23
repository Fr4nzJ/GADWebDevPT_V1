<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'status',
        'start_date',
        'end_date',
        'beneficiaries',
        'budget',
        'location',
        'objectives',
        'target_group',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'objectives' => 'array',
    ];

    /**
     * Get the human-readable category name
     */
    public function getCategoryDisplayAttribute(): string
    {
        return match ($this->category) {
            'women_empowerment' => 'Women Empowerment',
            'education' => 'Education & Skills',
            'safety' => 'Safety & Protection',
            'leadership' => 'Leadership Development',
            'lgbtq' => 'LGBTQ+ Rights',
            'mainstreaming' => 'Gender Mainstreaming',
            default => $this->category,
        };
    }

    /**
     * Get the status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'ongoing' => '#48c774',
            'completed' => '#3273dc',
            'upcoming' => '#f0ad4e',
            'suspended' => '#e74c3c',
            default => '#999',
        };
    }

    /**
     * Get the status badge background color
     */
    public function getStatusBgAttribute(): string
    {
        return match ($this->status) {
            'ongoing' => '#e8f8f0',
            'completed' => '#e8f1ff',
            'upcoming' => '#fff8e1',
            'suspended' => '#ffe8e8',
            default => '#f5f5f5',
        };
    }
}
