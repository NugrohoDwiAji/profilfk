<?php

namespace App\Filament\Resources\TeachingHospitals;

use App\Filament\Forms\Components\TranslatableInput;
use App\Filament\Resources\TeachingHospitals\Pages\CreateTeachingHospital;
use App\Filament\Resources\TeachingHospitals\Pages\EditTeachingHospital;
use App\Filament\Resources\TeachingHospitals\Pages\ListTeachingHospitals;
use App\Models\TeachingHospital;
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

class TeachingHospitalResource extends Resource
{
    protected static ?string $model = TeachingHospital::class;

    protected static ?string $slug = 'teaching-hospitals';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    protected static ?string $navigationLabel = 'RS Pendidikan';

    protected static ?string $modelLabel = 'Rumah Sakit Pendidikan';

    protected static ?string $pluralModelLabel = 'Rumah Sakit Pendidikan';

    protected static string|UnitEnum|null $navigationGroup = 'Konten Publik';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informasi Rumah Sakit Pendidikan & Wahana Klinis')
                    ->columnSpanFull()
                    ->description('Kelola profil rumah sakit pendidikan utama, rumah sakit satelit, dan jejaring pendidikan klinis dokter muda.')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                FileUpload::make('image_url')
                                    ->label('Foto / Gedung Rumah Sakit')
                                    ->image()
                                    ->imageEditor()
                                    ->imageCropAspectRatio('16:9')
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '16:10',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->directory('hospitals')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->maxSize(5120)
                                    ->helperText('Unggah foto rumah sakit (JPG/PNG/WebP, disarankan rasio lanskap 16:9, maks. 5MB).')
                                    ->columnSpan(['default' => 12, 'lg' => 5]),

                                Grid::make(1)
                                    ->schema([
                                        TranslatableInput::text('name', 'Nama Rumah Sakit', required: true),

                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('slug')
                                                    ->required()
                                                    ->unique(ignoreRecord: true),
                                                Select::make('type')
                                                    ->label('Klasifikasi Rumah Sakit')
                                                    ->options(TeachingHospital::TYPES)
                                                    ->default('utama')
                                                    ->required(),
                                            ]),

                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('accreditation')
                                                    ->label('Status Akreditasi')
                                                    ->placeholder('Misal: Terakreditasi Paripurna (KARS)')
                                                    ->nullable(),
                                                TextInput::make('capacity')
                                                    ->label('Kapasitas Fasilitas')
                                                    ->placeholder('Misal: 320+ Tempat Tidur')
                                                    ->nullable(),
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

                        TranslatableInput::textarea('description', 'Deskripsi & Profil Wahana Pendidikan', required: true, rows: 4),

                        Grid::make(12)
                            ->schema([
                                TextInput::make('address')
                                    ->label('Alamat Lengkap')
                                    ->placeholder('Jl. H. Lalu Hasyim, Praya, Lombok Tengah')
                                    ->columnSpan(['default' => 12, 'md' => 6]),

                                TextInput::make('city')
                                    ->label('Kota / Kabupaten')
                                    ->placeholder('Lombok Tengah / Mataram')
                                    ->columnSpan(['default' => 12, 'md' => 3]),

                                TextInput::make('province')
                                    ->label('Provinsi')
                                    ->default('Nusa Tenggara Barat')
                                    ->columnSpan(['default' => 12, 'md' => 3]),
                            ]),

                        Grid::make(12)
                            ->schema([
                                TextInput::make('director_name')
                                    ->label('Direktur RS / Koordinator Klinis')
                                    ->placeholder('Nama Direktur atau Ketua Komkordik')
                                    ->columnSpan(['default' => 12, 'md' => 4]),

                                TextInput::make('mou_number')
                                    ->label('Nomor Kerjasama / PKS')
                                    ->placeholder('Misal: PKS No. 045/UBG/RSUD-PRY/2024')
                                    ->columnSpan(['default' => 12, 'md' => 4]),

                                TextInput::make('phone')
                                    ->label('Telepon RS')
                                    ->placeholder('(0370) 654007')
                                    ->columnSpan(['default' => 12, 'md' => 4]),
                            ]),

                        Grid::make(12)
                            ->schema([
                                TextInput::make('email')
                                    ->label('Email Resmi RS')
                                    ->email()
                                    ->placeholder('rsud@lomboktengahkab.go.id')
                                    ->columnSpan(['default' => 12, 'md' => 4]),

                                TextInput::make('website_url')
                                    ->label('Website Resmi RS')
                                    ->url()
                                    ->placeholder('https://rsudpraya.lomboktengahkab.go.id')
                                    ->columnSpan(['default' => 12, 'md' => 4]),

                                TextInput::make('google_maps_url')
                                    ->label('Tautan Google Maps Lokasi')
                                    ->placeholder('https://maps.google.com/?q=...')
                                    ->columnSpan(['default' => 12, 'md' => 4]),
                            ]),

                        TagsInput::make('departments')
                            ->label('Departemen / Bagian Rotasi Klinis (Stase)')
                            ->placeholder('Tambah departemen klinis... (Tekan Enter)')
                            ->helperText('Contoh: Departemen Penyakit Dalam, Ilmu Bedah, Kesehatan Anak, Obstetri & Ginekologi, dll.'),

                        TagsInput::make('facilities')
                            ->label('Fasilitas Pendidikan & Klinis')
                            ->placeholder('Tambah fasilitas penunjang... (Tekan Enter)')
                            ->helperText('Contoh: Ruang Diskusi Dokter Muda, Kamar Jaga Coass, Perpustakaan Klinis, Ruang Sidang Kasus, dll.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Foto RS')
                    ->checkFileExistence(false)
                    ->state(fn (TeachingHospital $record): ?string => $record->image_src)
                    ->height(48)
                    ->width(80)
                    ->extraImgAttributes(['class' => 'object-cover rounded-lg shadow-2xs border border-steel-200/80']),

                TextColumn::make('name')
                    ->label('Nama Rumah Sakit')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('type')
                    ->label('Klasifikasi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'utama' => 'primary',
                        'satelit' => 'info',
                        'afiliasi' => 'secondary',
                        'jejaring' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => TeachingHospital::TYPES[$state] ?? $state)
                    ->sortable(),

                TextColumn::make('city')
                    ->label('Kota/Kab')
                    ->sortable(),

                TextColumn::make('accreditation')
                    ->label('Akreditasi')
                    ->badge()
                    ->color('success')
                    ->placeholder('-'),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->alignCenter(),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Klasifikasi RS')
                    ->options(TeachingHospital::TYPES),
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
            'index' => ListTeachingHospitals::route('/'),
            'create' => CreateTeachingHospital::route('/create'),
            'edit' => EditTeachingHospital::route('/{record}/edit'),
        ];
    }
}
