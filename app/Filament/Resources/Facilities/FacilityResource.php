<?php

namespace App\Filament\Resources\Facilities;

use App\Filament\Forms\Components\TranslatableInput;
use App\Filament\Resources\Facilities\Pages\CreateFacility;
use App\Filament\Resources\Facilities\Pages\EditFacility;
use App\Filament\Resources\Facilities\Pages\ListFacilities;
use App\Models\Facility;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
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
use Filament\Tables\Table;
use UnitEnum;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $navigationLabel = 'Fasilitas & Lab';

    protected static ?string $modelLabel = 'Fasilitas';

    protected static ?string $pluralModelLabel = 'Fasilitas & Laboratorium';

    protected static string|UnitEnum|null $navigationGroup = 'Konten Publik';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Fasilitas & Sarana Belajar (3 Bahasa)')
                    ->columnSpanFull()
                    ->description('Kelola sarana laboratorium, skills lab, rumah sakit pendidikan, dan pusat referensi.')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                FileUpload::make('image_url')
                                    ->label('Foto / Dokumentasi Sarana & Lab')
                                    ->image()
                                    ->imageEditor()
                                    ->imageCropAspectRatio('16:9')
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '16:10',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->directory('facilities')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->maxSize(5120)
                                    ->helperText('Unggah foto sarana/lab (JPG/PNG/WebP, disarankan rasio lanskap 16:9 atau 16:10 sesuai kartu publik, maks. 5MB).')
                                    ->columnSpan(['default' => 12, 'lg' => 5]),

                                Grid::make(1)
                                    ->schema([
                                        TranslatableInput::text('name', 'Nama Fasilitas', required: true),

                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('slug')
                                                    ->required()
                                                    ->unique(ignoreRecord: true),
                                                Select::make('category')
                                                    ->label('Kategori Sarana')
                                                    ->options([
                                                        'Simulasi & Keterampilan' => 'Simulasi & Keterampilan',
                                                        'Laboratorium' => 'Laboratorium',
                                                        'Wahana Pendidikan Klinis' => 'Wahana Pendidikan Klinis',
                                                        'Sumber Belajar' => 'Sumber Belajar',
                                                    ])
                                                    ->required(),
                                            ]),

                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('sort_order')
                                                    ->numeric()
                                                    ->default(1)
                                                    ->label('Urutan Tampil'),
                                                Toggle::make('is_active')
                                                    ->label('Aktif Ditampilkan')
                                                    ->default(true),
                                            ]),
                                    ])
                                    ->columnSpan(['default' => 12, 'lg' => 7]),
                            ]),

                        TranslatableInput::textarea('description', 'Deskripsi Lengkap Fasilitas', required: true, rows: 4),

                        TagsInput::make('features')
                            ->label('Daftar Fitur / Kelengkapan Medis (Ketik lalu tekan Enter)')
                            ->placeholder('Tambah fitur baru...')
                            ->helperText('Contoh: Manikin resusitasi, Mikroskop digital, Ruang OSCE, dll.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Foto Sarana')
                    ->checkFileExistence(false)
                    ->state(fn (Facility $record): ?string => $record->image_src)
                    ->height(48)
                    ->width(80)
                    ->extraImgAttributes(['class' => 'object-cover rounded-lg shadow-2xs border border-steel-200/80']),
                TextColumn::make('name')
                    ->label('Nama Fasilitas')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('info'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'Simulasi & Keterampilan' => 'Simulasi & Keterampilan',
                        'Laboratorium' => 'Laboratorium',
                        'Wahana Pendidikan Klinis' => 'Wahana Pendidikan Klinis',
                        'Sumber Belajar' => 'Sumber Belajar',
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
            'index' => ListFacilities::route('/'),
            'create' => CreateFacility::route('/create'),
            'edit' => EditFacility::route('/{record}/edit'),
        ];
    }
}
