<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
    ];

    /**
     * Get a setting by key with a fallback default.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        return Cache::rememberForever("site_setting_{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value and clear its cache.
     */
    public static function set(string $key, ?string $value, string $type = 'text'): self
    {
        Cache::forget("site_setting_{$key}");
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );
    }
}
