<?php

namespace App\Models;

use App\Casts\TranslatableCast;
use App\Models\Concerns\CleansUpFiles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationStructure extends Model
{
    use CleansUpFiles;
    use HasFactory;

    protected array $fileAttributes = ['image_url'];

    protected $fillable = [
        'title',
        'description',
        'academic_period',
        'image_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'title' => TranslatableCast::class,
        'description' => TranslatableCast::class,
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope query to only include active records ordered by sort_order.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc');
    }

    /**
     * Resolve the full accessible URL or public asset path for the structure image.
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

    /**
     * Seed initial default organization structure if table is empty.
     */
    public static function seedDefaults(): void
    {
        if (static::count() > 0) {
            return;
        }

        static::create([
            'title' => [
                'id' => 'Struktur Organisasi Fakultas Kedokteran',
                'en' => 'Organizational Structure of Faculty of Medicine',
                'zh' => '医学院组织架构',
            ],
            'description' => [
                'id' => 'Bagan tata kelola dan hierarki kepemimpinan Fakultas Kedokteran Universitas Bumigora periode berjalan.',
                'en' => 'Governance chart and leadership hierarchy of Faculty of Medicine Universitas Bumigora.',
                'zh' => '布米戈拉大学医学院现行治理图表与领导层级架构。',
            ],
            'academic_period' => 'Periode 2024 - 2028',
            'image_url' => 'images/structure/struktur-organisasi-fk-ubg.svg',
            'is_active' => true,
            'sort_order' => 1,
        ]);
    }
}
