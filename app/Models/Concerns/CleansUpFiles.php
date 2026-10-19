<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

trait CleansUpFiles
{
    /**
     * Boot the trait to hook into model lifecycle events.
     */
    public static function bootCleansUpFiles(): void
    {
        static::deleting(function (Model $model): void {
            foreach ($model->getFileCleanupAttributes() as $attribute) {
                $path = $model->getAttribute($attribute);

                if (blank($path)) {
                    continue;
                }

                // If another record still uses this exact file path, do not delete it
                $isReferencedElsewhere = static::where($attribute, $path)
                    ->where($model->getKeyName(), '!=', $model->getKey())
                    ->exists();

                if (! $isReferencedElsewhere) {
                    static::deleteStoredFile($path, $model->getFileCleanupDisk());
                }
            }
        });

        static::updating(function (Model $model): void {
            foreach ($model->getFileCleanupAttributes() as $attribute) {
                if ($model->isDirty($attribute)) {
                    $original = $model->getOriginal($attribute);
                    $current = $model->getAttribute($attribute);

                    if (blank($original) || $original === $current) {
                        continue;
                    }

                    // If another record still uses this exact file path, do not delete it
                    $isReferencedElsewhere = static::where($attribute, $original)
                        ->where($model->getKeyName(), '!=', $model->getKey())
                        ->exists();

                    if (! $isReferencedElsewhere) {
                        static::deleteStoredFile($original, $model->getFileCleanupDisk());
                    }
                }
            }
        });
    }

    /**
     * Get the attributes containing file paths to clean up.
     *
     * @return array<int, string>
     */
    public function getFileCleanupAttributes(): array
    {
        return property_exists($this, 'fileAttributes')
            ? (array) $this->fileAttributes
            : ['image_url'];
    }

    /**
     * Get the storage disk used for file cleanup.
     */
    public function getFileCleanupDisk(): string
    {
        return property_exists($this, 'fileDisk')
            ? (string) $this->fileDisk
            : 'public';
    }

    /**
     * Permanently delete a stored file from disk.
     */
    public static function deleteStoredFile(string|array|null $path, string $disk = 'public'): void
    {
        if (blank($path)) {
            return;
        }

        if (is_array($path)) {
            foreach ($path as $item) {
                static::deleteStoredFile($item, $disk);
            }

            return;
        }

        // Do not delete external URLs
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return;
        }

        $cleaned = ltrim($path, '/');

        // Do not delete static images in public/images
        if (str_starts_with($cleaned, 'images/')) {
            return;
        }

        // If the path was stored with a leading "storage/" prefix
        if (str_starts_with($cleaned, 'storage/')) {
            $cleaned = substr($cleaned, 8);
        }

        $storage = Storage::disk($disk);

        if ($storage->exists($cleaned)) {
            $storage->delete($cleaned);
        }
    }
}
