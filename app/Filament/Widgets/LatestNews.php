<?php

namespace App\Filament\Widgets;

use App\Models\News;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestNews extends TableWidget
{
    protected static ?int $sort = 3;

    protected static bool $isLazy = false;

    protected static ?string $heading = 'Berita & Pengumuman Terbaru';

    protected int|string|array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => News::query()->latest('published_at')->limit(5)
            )
            ->paginated(false)
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Berita')
                    ->limit(35)
                    ->weight('bold')
                    ->tooltip(fn (News $record): string => (string) $record->title),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('info'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('views_count')
                    ->label('Dilihat')
                    ->numeric(),
            ])
            ->recordActions([
                Action::make('edit')
                    ->label('Edit')
                    ->icon(Heroicon::OutlinedPencilSquare)
                    ->url(fn (News $record): string => url("/admin/news/{$record->id}/edit")),
            ]);
    }
}
