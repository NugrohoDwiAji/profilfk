<?php

namespace App\Casts;

use App\Support\TranslatableString;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class TranslatableCast implements CastsAttributes
{
    /**
     * Cast the given value.
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): TranslatableString
    {
        return new TranslatableString($value);
    }

    /**
     * Prepare the given value for storage.
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if (is_null($value)) {
            return null;
        }

        if ($value instanceof TranslatableString) {
            return json_encode($value->toArray(), JSON_UNESCAPED_UNICODE);
        }

        if (is_array($value)) {
            return json_encode([
                'id' => (string) ($value['id'] ?? ''),
                'en' => (string) ($value['en'] ?? ''),
                'zh' => (string) ($value['zh'] ?? ''),
            ], JSON_UNESCAPED_UNICODE);
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $value;
            }

            return json_encode([
                'id' => $value,
                'en' => '',
                'zh' => '',
            ], JSON_UNESCAPED_UNICODE);
        }

        return null;
    }
}
