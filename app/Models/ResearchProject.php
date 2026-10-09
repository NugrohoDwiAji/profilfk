<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'leader_name',
        'summary',
        'description',
        'publication_date',
        'partner_institution',
        'featured_image',
        'status',
    ];

    protected $casts = [
        'publication_date' => 'date',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->orderBy('publication_date', 'desc');
    }
}
