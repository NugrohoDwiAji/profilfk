<?php

namespace App\Filament\Resources\TeachingHospitals\Pages;

use App\Filament\Resources\TeachingHospitals\TeachingHospitalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTeachingHospitals extends ListRecords
{
    protected static string $resource = TeachingHospitalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah RS Pendidikan'),
        ];
    }
}
