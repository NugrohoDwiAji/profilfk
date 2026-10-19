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
     * Get a setting by key with a fallback default and locale resolution.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        $setting = static::where('key', $key)->first();

        if (! $setting) {
            return $default;
        }

        $val = $setting->value;
        $locale = app()->getLocale();

        if (is_string($val) && str_starts_with(trim($val), '{')) {
            $decoded = json_decode($val, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                if (! empty($decoded[$locale])) {
                    return $decoded[$locale];
                }

                if (! empty($decoded['id'])) {
                    $idVal = $decoded['id'];
                    if ($locale !== 'id') {
                        $translated = __($idVal, [], $locale);
                        if ($translated !== $idVal) {
                            return $translated;
                        }
                    }

                    return $idVal;
                }

                if (! empty($decoded['en'])) {
                    return $decoded['en'];
                }

                if (! empty($decoded['zh'])) {
                    return $decoded['zh'];
                }

                return reset($decoded) ?: $default;
            }
        }

        if ($val !== null && $locale !== 'id') {
            $translated = __($val, [], $locale);
            if ($translated !== $val) {
                return $translated;
            }
        }

        return $val ?? $default;
    }

    /**
     * Set a setting value and clear its cache.
     */
    public static function set(string $key, mixed $value, string $type = 'text'): self
    {
        Cache::forget("site_setting_{$key}");

        if (is_array($value)) {
            $value = json_encode([
                'id' => (string) ($value['id'] ?? ''),
                'en' => (string) ($value['en'] ?? ''),
                'zh' => (string) ($value['zh'] ?? ''),
            ], JSON_UNESCAPED_UNICODE);
        }

        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );
    }

    /**
     * Get all settings as key-value array map with locale resolution.
     *
     * @return array<string, string|null>
     */
    public static function allMap(): array
    {
        try {
            $locale = app()->getLocale();
            $raw = static::pluck('value', 'key')->all();
            $result = [];

            foreach ($raw as $key => $val) {
                if (is_string($val) && str_starts_with(trim($val), '{')) {
                    $decoded = json_decode($val, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        if (! empty($decoded[$locale])) {
                            $result[$key] = $decoded[$locale];

                            continue;
                        }

                        if (! empty($decoded['id'])) {
                            $idVal = $decoded['id'];
                            if ($locale !== 'id') {
                                $translated = __($idVal, [], $locale);
                                if ($translated !== $idVal) {
                                    $result[$key] = $translated;

                                    continue;
                                }
                            }
                            $result[$key] = $idVal;

                            continue;
                        }

                        if (! empty($decoded['en'])) {
                            $result[$key] = $decoded['en'];

                            continue;
                        }

                        if (! empty($decoded['zh'])) {
                            $result[$key] = $decoded['zh'];

                            continue;
                        }

                        $result[$key] = reset($decoded) ?: '';

                        continue;
                    }
                }

                if ($val !== null && $locale !== 'id') {
                    $translated = __($val, [], $locale);
                    if ($translated !== $val) {
                        $result[$key] = $translated;

                        continue;
                    }
                }

                $result[$key] = $val;
            }

            return $result;
        } catch (\Throwable) {
            return [];
        }
    }
}
