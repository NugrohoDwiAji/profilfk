<?php

namespace App\Models;

use App\Casts\TranslatableCast;
use App\Models\Concerns\CleansUpFiles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use CleansUpFiles;
    use HasFactory;

    protected array $fileAttributes = ['featured_image'];

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'featured_image',
        'published_at',
        'status',
        'views_count',
    ];

    protected $casts = [
        'title' => TranslatableCast::class,
        'excerpt' => TranslatableCast::class,
        'content' => TranslatableCast::class,
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');
    }

    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->content));

        return max(1, (int) ceil($words / 200));
    }

    public function getImageSrcAttribute(): ?string
    {
        if (! $this->featured_image) {
            return null;
        }

        if (str_starts_with($this->featured_image, 'http://') || str_starts_with($this->featured_image, 'https://')) {
            return $this->featured_image;
        }

        $cleaned = ltrim($this->featured_image, '/');

        if (file_exists(public_path($cleaned))) {
            return asset($cleaned);
        }

        return asset('storage/'.$cleaned);
    }
}
