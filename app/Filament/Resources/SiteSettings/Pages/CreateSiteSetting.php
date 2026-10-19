<?php

namespace App\Filament\Resources\SiteSettings\Pages;

use App\Filament\Resources\SiteSettings\SiteSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSiteSetting extends CreateRecord
{
    protected static string $resource = SiteSettingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
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
