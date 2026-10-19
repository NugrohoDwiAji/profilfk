<?php

namespace App\Filament\Resources\OrganizationStructures;

use App\Filament\Forms\Components\TranslatableInput;
use App\Filament\Resources\OrganizationStructures\Pages\CreateOrganizationStructure;
use App\Filament\Resources\OrganizationStructures\Pages\EditOrganizationStructure;
use App\Filament\Resources\OrganizationStructures\Pages\ListOrganizationStructures;
use App\Models\OrganizationStructure;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
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
use Filament\Tables\Table;
use UnitEnum;

class OrganizationStructureResource extends Resource
{
    protected static ?string $model = OrganizationStructure::class;

    protected static ?string $slug = 'organization-structures';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquare3Stack3d;

    protected static ?string $navigationLabel = 'Struktur Organisasi';

    protected static ?string $modelLabel = 'Struktur Organisasi';

    protected static ?string $pluralModelLabel = 'Bagan Struktur Organisasi';

    protected static string|UnitEnum|null $navigationGroup = 'Konten Publik';

    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Bagan Struktur Organisasi Fakultas')
                    ->columnSpanFull()
                    ->description('Kelola gambar bagan struktur organisasi tata kelola (SOTK), judul, periode, dan keterangan pelengkap.')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                FileUpload::make('image_url')
                                    ->label('Gambar / Bagan Struktur Organisasi')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('organization')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->required()
                                    ->maxSize(10240)
                                    ->helperText('Unggah bagan struktur organisasi (format JPG, PNG, WebP, atau SVG, maks. 10MB).')
                                    ->columnSpan(['default' => 12, 'lg' => 5]),

                                Grid::make(1)
                                    ->schema([
                                        TranslatableInput::text('title', 'Judul Bagan Struktur Organisasi', required: true),

                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('academic_period')
                                                    ->label('Periode Kepengurusan / Akademik')
                                                    ->placeholder('Misal: Periode 2024 - 2028')
                                                    ->nullable(),

                                                TextInput::make('sort_order')
                                                    ->numeric()
                                                    ->default(1)
                                                    ->label('Urutan Tampil'),
                                            ]),

                                        Toggle::make('is_active')
                                            ->label('Aktif Ditampilkan di Halaman Profil')
                                            ->default(true),
                                    ])
                                    ->columnSpan(['default' => 12, 'lg' => 7]),
                            ]),

                        TranslatableInput::textarea('description', 'Keterangan Tambahan / Deskripsi Bagan', required: false, rows: 3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Bagan')
                    ->checkFileExistence(false)
                    ->state(fn (OrganizationStructure $record): ?string => $record->image_src)
                    ->height(54)
                    ->width(90)
                    ->extraImgAttributes(['class' => 'object-contain rounded-lg shadow-2xs border border-steel-200/80 bg-white p-1']),

                TextColumn::make('title')
                    ->label('Judul Bagan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('academic_period')
                    ->label('Periode')
                    ->badge()
                    ->color('info')
                    ->placeholder('-'),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->alignCenter(),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
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
            'index' => ListOrganizationStructures::route('/'),
            'create' => CreateOrganizationStructure::route('/create'),
            'edit' => EditOrganizationStructure::route('/{record}/edit'),
        ];
    }
}
