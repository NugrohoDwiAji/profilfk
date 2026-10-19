<?php

namespace App\Filament\Resources\SiteSettings\Pages;

use App\Filament\Resources\SiteSettings\SiteSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSiteSetting extends EditRecord
{
    protected static string $resource = SiteSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $val = $data['value'] ?? '';

        if (is_string($val) && str_starts_with(trim($val), '{')) {
            $decoded = json_decode($val, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $data['value_id'] = $decoded['id'] ?? '';
                $data['value_en'] = $decoded['en'] ?? '';
                $data['value_zh'] = $decoded['zh'] ?? '';

                return $data;
            }
        }

        $data['value_id'] = $val;
        $data['value_en'] = '';
        $data['value_zh'] = '';

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (! empty($data['value_id']) || ! empty($data['value_en']) || ! empty($data['value_zh'])) {
            $data['value'] = json_encode([
                'id' => (string) ($data['value_id'] ?? ''),
                'en' => (string) ($data['value_en'] ?? ''),
                'zh' => (string) ($data['value_zh'] ?? ''),
            ], JSON_UNESCAPED_UNICODE);
        }

        unset($data['value_id'], $data['value_en'], $data['value_zh']);

        return $data;
    }
}
