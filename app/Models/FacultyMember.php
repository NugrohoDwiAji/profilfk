<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'academic_title',
        'position',
        'category',
        'specialization',
        'department',
        'photo_url',
        'email',
        'bio',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }

    public function getFormattedNameAttribute(): string
    {
        return $this->name;
    }
}
