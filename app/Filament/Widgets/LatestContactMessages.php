<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestContactMessages extends TableWidget
{
    protected static ?int $sort = 2;

    protected static bool $isLazy = false;

    protected static ?string $heading = 'Pesan Kontak Masuk Terbaru';

    protected int|string|array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => ContactMessage::query()->latest()->limit(5)
            )
            ->paginated(false)
            ->columns([
                TextColumn::make('name')
                    ->label('Pengirim')
                    ->limit(20)
                    ->weight('bold'),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('info'),
                IconColumn::make('is_read')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedCheckCircle)
                    ->falseIcon(Heroicon::OutlinedExclamationCircle)
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->since(),
            ])
            ->recordActions([
                Action::make('open')
                    ->label('Buka')
                    ->icon(Heroicon::OutlinedEye)
                    ->url(fn (ContactMessage $record): string => url("/admin/contact-messages/{$record->id}/edit")),
            ]);
    }
}
