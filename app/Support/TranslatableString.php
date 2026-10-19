<?php

namespace App\Support;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Stringable;

class TranslatableString implements Arrayable, ArrayAccess, JsonSerializable, Stringable
{
    /**
     * @var array<string, string>
     */
    protected array $translations = [];

    public function __construct(array|string|null $value = null)
    {
        if (is_array($value)) {
            $this->translations = [
                'id' => (string) ($value['id'] ?? ''),
                'en' => (string) ($value['en'] ?? ''),
                'zh' => (string) ($value['zh'] ?? ''),
            ];
        } elseif (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $this->translations = [
                    'id' => (string) ($decoded['id'] ?? ''),
                    'en' => (string) ($decoded['en'] ?? ''),
                    'zh' => (string) ($decoded['zh'] ?? ''),
                ];
            } else {
                $this->translations = [
                    'id' => $value,
                    'en' => '',
                    'zh' => '',
                ];
            }
        } else {
            $this->translations = [
                'id' => '',
                'en' => '',
                'zh' => '',
            ];
        }
    }

    /**
     * Get translated string based on locale with fallback.
     */
    public function get(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        if (! empty($this->translations[$locale])) {
            return $this->translations[$locale];
        }

        // Fallback hierarchy: id -> en -> zh -> first non-empty
        if (! empty($this->translations['id'])) {
            $idText = $this->translations['id'];
            if ($locale !== 'id') {
                $translated = __($idText, [], $locale);
                if ($translated !== $idText) {
                    return $translated;
                }
            }

            return $idText;
        }

        if (! empty($this->translations['en'])) {
            return $this->translations['en'];
        }

        if (! empty($this->translations['zh'])) {
            return $this->translations['zh'];
        }

        return '';
    }

    public function __toString(): string
    {
        return $this->get();
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return $this->translations;
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return $this->translations;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->translations[$offset]);
    }

    public function offsetGet(mixed $offset): ?string
    {
        return $this->translations[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->translations[$offset] = (string) $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->translations[$offset]);
    }
}
