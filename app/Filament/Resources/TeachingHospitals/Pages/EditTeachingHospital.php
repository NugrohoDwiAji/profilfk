<?php

namespace App\Filament\Resources\TeachingHospitals\Pages;

use App\Filament\Resources\TeachingHospitals\TeachingHospitalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditTeachingHospital extends EditRecord
{
    protected static string $resource = TeachingHospitalResource::class;

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
