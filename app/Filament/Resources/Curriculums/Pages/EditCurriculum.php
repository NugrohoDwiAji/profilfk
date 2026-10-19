<?php

namespace App\Filament\Resources\Curriculums\Pages;

use App\Filament\Resources\Curriculums\CurriculumResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditCurriculum extends EditRecord
{
    protected static string $resource = CurriculumResource::class;

    protected Width|string|null $maxContentWidth = Width::Full;

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
