<?php

namespace App\Models;

use App\Casts\TranslatableCast;
use App\Models\Concerns\CleansUpFiles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use CleansUpFiles;
    use HasFactory;

    protected array $fileAttributes = ['image_url'];

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
        'name' => TranslatableCast::class,
        'tagline' => TranslatableCast::class,
        'description' => TranslatableCast::class,
        'curriculum_summary' => TranslatableCast::class,
        'career_prospects' => 'array',
        'is_active' => 'boolean',
        'duration_semesters' => 'integer',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }

    /**
     * Get the resolved URL for the program cover image.
     */
    public function getImageSrcAttribute(): ?string
    {
        if (! $this->image_url) {
            return null;
        }

        if (str_starts_with($this->image_url, 'http://') || str_starts_with($this->image_url, 'https://')) {
            return $this->image_url;
        }

        $cleaned = ltrim($this->image_url, '/');

        if (file_exists(public_path($cleaned))) {
            return asset($cleaned);
        }

        return asset('storage/'.$cleaned);
    }
}
