<?php

namespace App\Models;

use App\Casts\TranslatableCast;
use App\Models\Concerns\CleansUpFiles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyMember extends Model
{
    use CleansUpFiles;
    use HasFactory;

    protected array $fileAttributes = ['photo_url'];

    protected $fillable = [
        'name',
        'academic_title',
        'nik',
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
        'name' => TranslatableCast::class,
        'academic_title' => TranslatableCast::class,
        'position' => TranslatableCast::class,
        'specialization' => TranslatableCast::class,
        'department' => TranslatableCast::class,
        'bio' => TranslatableCast::class,
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public const CATEGORIES = [
        'pimpinan' => 'Pimpinan',
        'pakar_med_ed' => 'Dosen Pakar Pendidikan Kedokteran (Medical Education)',
        'bioetik_medikolegal' => 'Dosen Ilmu Bioetik dan Medikolegal',
        'komunitas_pencegahan' => 'Dosen Ilmu Kedokteran Komunitas dan Pencegahan',
        'dosen_biomedik' => 'Dosen Ilmu Biomedik',
        'dosen_spesialis' => 'Dosen Spesialis',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }

    public function scopeWithCategory(Builder $query, string $category): Builder
    {
        return $query->where(function (Builder $q) use ($category) {
            $q->whereJsonContains('category', $category)
                ->orWhere('category', 'like', '%"'.$category.'"%');
        });
    }

    /**
     * @return array<string>
     */
    public function getCategoryAttribute(mixed $value): array
    {
        if (is_array($value)) {
            $categories = $value;
        } elseif (blank($value)) {
            $categories = [];
        } else {
            $decoded = json_decode((string) $value, true);
            $categories = (json_last_error() === JSON_ERROR_NONE && is_array($decoded))
                ? $decoded
                : [$value];
        }

        return array_values(array_unique(array_map(function ($cat): string {
            return match ((string) $cat) {
                'dosen_klinis', 'spesialis' => 'dosen_spesialis',
                'biomedik' => 'dosen_biomedik',
                'pakar_pendidikan_kedokteran' => 'pakar_med_ed',
                default => (string) $cat,
            };
        }, $categories)));
    }

    public function setCategoryAttribute(mixed $value): void
    {
        if (is_array($value)) {
            $normalized = array_values(array_unique(array_filter($value)));
            $this->attributes['category'] = json_encode($normalized);
        } elseif (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $this->attributes['category'] = json_encode(array_values(array_unique(array_filter($decoded))));
            } elseif (filled($value)) {
                $this->attributes['category'] = json_encode([$value]);
            } else {
                $this->attributes['category'] = json_encode([]);
            }
        } else {
            $this->attributes['category'] = json_encode([]);
        }
    }

    public function hasCategory(string $category): bool
    {
        return in_array($category, $this->category, true);
    }

    /**
     * @return array<string>
     */
    public function getCategoryLabelsAttribute(): array
    {
        return array_map(
            fn (string $cat): string => __(self::CATEGORIES[$cat] ?? $cat),
            $this->category
        );
    }

    public function getPrimaryCategoryLabelAttribute(): string
    {
        $labels = $this->category_labels;

        return ! empty($labels) ? implode(' • ', $labels) : __('Dosen');
    }

    public function getFormattedNameAttribute(): string
    {
        return (string) $this->name;
    }

    public function getPhotoSrcAttribute(): ?string
    {
        if (! $this->photo_url) {
            return null;
        }

        if (str_starts_with($this->photo_url, 'http://') || str_starts_with($this->photo_url, 'https://')) {
            return $this->photo_url;
        }

        $cleaned = ltrim($this->photo_url, '/');

        if (file_exists(public_path($cleaned))) {
            return asset($cleaned);
        }

        return asset('storage/'.$cleaned);
    }
}
