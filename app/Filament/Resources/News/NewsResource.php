<?php

namespace App\Filament\Resources\News;

use App\Filament\Forms\Components\TranslatableInput;
use App\Filament\Resources\News\Pages\CreateNews;
use App\Filament\Resources\News\Pages\EditNews;
use App\Filament\Resources\News\Pages\ListNews;
use App\Models\News;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?string $navigationLabel = 'Berita & Pengumuman';

    protected static ?string $modelLabel = 'Berita';

    protected static ?string $pluralModelLabel = 'Berita & Pengumuman';

    protected static string|UnitEnum|null $navigationGroup = 'Konten Publik';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Konten Berita (3 Bahasa)')
                    ->description('Masukkan konten berita dalam Bahasa Indonesia, Inggris, dan Mandarin.')
                    ->schema([
                        TranslatableInput::text('title', 'Judul Berita', required: true),

                        Grid::make(4)
                            ->schema([
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->helperText('URL slug unik untuk artikel ini.'),
                                Select::make('category')
                                    ->label('Kategori')
                                    ->options([
                                        'Akademik' => 'Akademik',
                                        'Kerjasama' => 'Kerjasama',
                                        'Kegiatan' => 'Kegiatan',
                                        'Pengumuman' => 'Pengumuman',
                                        'Internal' => 'Internal',
                                    ])
                                    ->required(),
                                Select::make('status')
                                    ->label('Status Publikasi')
                                    ->options([
                                        'published' => 'Published (Tayang Publik)',
                                        'draft' => 'Draft (Internal)',
                                    ])
                                    ->default('published')
                                    ->required(),
                                DateTimePicker::make('published_at')
                                    ->label('Jadwal / Waktu Publikasi')
                                    ->default(now()),
                            ]),

                        FileUpload::make('featured_image')
                            ->label('Foto / Gambar Sampul Berita')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageEditorAspectRatios([
                                '16:9',
                                '16:10',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('news')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Unggah gambar sampul berita (JPG/PNG/WebP, disarankan rasio lanskap 16:9 atau 16:10, maks. 5MB).'),

                        TranslatableInput::textarea('excerpt', 'Kutipan Singkat (Excerpt)', required: true, rows: 3),

                        TranslatableInput::richEditor('content', 'Isi Konten Berita Lengkap', required: true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Sampul')
                    ->checkFileExistence(false)
                    ->state(fn (News $record): ?string => $record->image_src)
                    ->height(48)
                    ->width(72)
                    ->extraImgAttributes(['class' => 'object-cover rounded-lg shadow-2xs border border-steel-200/80']),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(45)
                    ->tooltip(fn ($record): string => (string) $record->title),
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
                TextColumn::make('published_at')
                    ->label('Tanggal Tayang')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('views_count')
                    ->label('Dilihat')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Filter Kategori')
                    ->options([
                        'Akademik' => 'Akademik',
                        'Kerjasama' => 'Kerjasama',
                        'Kegiatan' => 'Kegiatan',
                        'Pengumuman' => 'Pengumuman',
                    ]),
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'published' => 'Published',
                        'draft' => 'Draft',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNews::route('/'),
            'create' => CreateNews::route('/create'),
            'edit' => EditNews::route('/{record}/edit'),
        ];
    }
}
