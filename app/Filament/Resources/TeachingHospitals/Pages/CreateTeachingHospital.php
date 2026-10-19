<?php

namespace App\Filament\Resources\TeachingHospitals\Pages;

use App\Filament\Resources\TeachingHospitals\TeachingHospitalResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateTeachingHospital extends CreateRecord
{
    protected static string $resource = TeachingHospitalResource::class;

    protected Width|string|null $maxContentWidth = Width::Full;

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }
}
