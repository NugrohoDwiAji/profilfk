<?php

namespace App\Filament\Resources\FacultyMembers\Pages;

use App\Filament\Resources\FacultyMembers\FacultyMemberResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateFacultyMember extends CreateRecord
{
    protected static string $resource = FacultyMemberResource::class;

    protected Width|string|null $maxContentWidth = Width::Full;

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }
}
