<?php

namespace App\Filament\Resources\News\Pages;

use App\Filament\Resources\News\NewsResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    protected Width|string|null $maxContentWidth = Width::Full;

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }
}
