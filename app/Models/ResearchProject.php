<?php

namespace App\Models;

use App\Casts\TranslatableCast;
use App\Models\Concerns\CleansUpFiles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProject extends Model
{
    use CleansUpFiles;
    use HasFactory;

    protected array $fileAttributes = ['featured_image'];

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
        'title' => TranslatableCast::class,
        'summary' => TranslatableCast::class,
        'description' => TranslatableCast::class,
        'leader_name' => TranslatableCast::class,
        'partner_institution' => TranslatableCast::class,
        'publication_date' => 'date',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->orderBy('publication_date', 'desc');
    }
}
