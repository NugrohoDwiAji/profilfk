<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'degree',
        'slug',
        'tagline',
        'description',
        'curriculum_summary',
        'career_prospects',
        'duration_semesters',
        'degree_title',
        'accreditation',
        'image_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'career_prospects' => 'array',
        'is_active' => 'boolean',
        'duration_semesters' => 'integer',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }
}
