<?php

namespace App\Filament\Resources\Galleries;

use App\Filament\Forms\Components\TranslatableInput;
use App\Filament\Resources\Galleries\Pages\CreateGallery;
use App\Filament\Resources\Galleries\Pages\EditGallery;
use App\Filament\Resources\Galleries\Pages\ListGalleries;
use App\Models\Gallery;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use UnitEnum;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $slug = 'galleries';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Galeri Foto';

    protected static ?string $modelLabel = 'Foto Galeri';

    protected static ?string $pluralModelLabel = 'Galeri Foto & Dokumentasi';

    protected static string|UnitEnum|null $navigationGroup = 'Konten Publik';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Foto & Keterangan Galeri')
                    ->columnSpanFull()
                    ->description('Kelola dokumentasi foto kegiatan, fasilitas, dan aktivitas akademik Fakultas Kedokteran.')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                FileUpload::make('image_url')
                                    ->label('Foto / Gambar Galeri')
                                    ->image()
                                    ->imageEditor()
                                    ->imageCropAspectRatio('16:10')
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '16:10',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->directory('galleries')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->required()
                                    ->maxSize(5120)
                                    ->helperText('Unggah foto resolusi tinggi (format JPG, PNG, atau WebP, maks. 5MB).')
                                    ->columnSpan(['default' => 12, 'lg' => 5]),

                                Grid::make(1)
                                    ->schema([
                                        TranslatableInput::text('title', 'Judul Foto', required: true),

                                        Grid::make(2)
                                            ->schema([
                                                Select::make('category')
                                                    ->label('Kategori Foto')
                                                    ->options(Gallery::CATEGORIES)
                                                    ->searchable()
                                                    ->nullable()
                                                    ->placeholder('Pilih kategori...'),

                                                TextInput::make('sort_order')
                                                    ->numeric()
                                                    ->default(1)
                                                    ->label('Urutan Tampil'),
                                            ]),

                                        Toggle::make('is_active')
                                            ->label('Aktif Ditampilkan di Halaman Publik')
                                            ->default(true),
                                    ])
                                    ->columnSpan(['default' => 12, 'lg' => 7]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Foto')
                    ->checkFileExistence(false)
                    ->state(fn (Gallery $record): ?string => $record->image_src)
                    ->height(54)
                    ->width(80)
                    ->extraImgAttributes(['class' => 'object-cover rounded-lg shadow-2xs border border-steel-200/80']),

                TextColumn::make('title')
                    ->label('Judul Foto')
                    ->weight('bold')
                    ->searchable()
                    ->sortable()
                    ->limit(60),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->placeholder('Tanpa Kategori'),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->alignCenter(),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options(Gallery::CATEGORIES),

                TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
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
            'index' => ListGalleries::route('/'),
            'create' => CreateGallery::route('/create'),
            'edit' => EditGallery::route('/{record}/edit'),
        ];
    }
}
