<?php

namespace App\Filament\Resources\FacultyMembers\Pages;

use App\Filament\Resources\FacultyMembers\FacultyMemberResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditFacultyMember extends EditRecord
{
    protected static string $resource = FacultyMemberResource::class;

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
