<?php

namespace App\Filament\Resources\Curriculums;

use App\Filament\Forms\Components\TranslatableInput;
use App\Filament\Resources\Curriculums\Pages\CreateCurriculum;
use App\Filament\Resources\Curriculums\Pages\EditCurriculum;
use App\Filament\Resources\Curriculums\Pages\ListCurriculums;
use App\Models\Curriculum;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class CurriculumResource extends Resource
{
    protected static ?string $model = Curriculum::class;

    protected static ?string $slug = 'curriculums';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $navigationLabel = 'Kurikulum & Blok';

    protected static ?string $modelLabel = 'Mata Kuliah / Blok Kurikulum';

    protected static ?string $pluralModelLabel = 'Kurikulum & Blok Kedokteran';

    protected static string|UnitEnum|null $navigationGroup = 'Konten Publik';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Metode Pengisian Data: Ambil dari API / Manual')
                    ->columnSpanFull()
                    ->description('Gunakan opsi di bawah untuk menarik data dari API repositori SKDI/SNPPDI secara instan, atau lewati dan isi seluruh kolom secara manual di bawah.')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                Select::make('api_preset_selector')
                                    ->label('Pilih dari Direktori Repositori Standar API (SKDI / SNPPDI)')
                                    ->placeholder('-- Pilih mata kuliah standar untuk mengisi otomatis --')
                                    ->options(function () {
                                        $dict = Curriculum::getStandardDictionary();
                                        $options = [];
                                        foreach ($dict as $code => $item) {
                                            $options[$code] = "[{$code}] {$item['name']} ({$item['sks']} SKS - {$item['stage']})";
                                        }

                                        return $options;
                                    })
                                    ->searchable()
                                    ->dehydrated(false)
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if (empty($state)) {
                                            return;
                                        }
                                        $data = Curriculum::lookupByCode($state);
                                        if ($data) {
                                            $set('code', $data['code']);
                                            $set('name.id', $data['name']);
                                            $set('stage', $data['stage']);
                                            $set('semester', $data['semester'] ?? null);
                                            $set('academic_phase', $data['academic_phase'] ?? null);
                                            $set('sks', $data['sks']);
                                            $set('type', $data['type']);
                                            $set('duration', $data['duration'] ?? null);
                                            $set('location', $data['location'] ?? null);
                                            $set('description.id', $data['description'] ?? null);
                                            $set('api_id', $data['code']);

                                            Notification::make()
                                                ->title('Data Dimuat dari API')
                                                ->body("Data mata kuliah [{$data['code']}] {$data['name']} berhasil dimuat ke formulir.")
                                                ->success()
                                                ->send();
                                        }
                                    })
                                    ->columnSpan(['default' => 12, 'lg' => 6]),

                                TextInput::make('api_lookup_code')
                                    ->label('Atau Tarik Berdasarkan Kode Blok / MK dari API')
                                    ->placeholder('Ketik kode (misal: KED101, ROT001)')
                                    ->dehydrated(false)
                                    ->suffixAction(
                                        Action::make('fetchFromApi')
                                            ->label('Ambil dari API')
                                            ->icon(Heroicon::OutlinedArrowDownTray)
                                            ->color('primary')
                                            ->action(function (callable $set, callable $get) {
                                                $code = (string) $get('api_lookup_code');
                                                if (empty(trim($code))) {
                                                    Notification::make()
                                                        ->title('Kode Masih Kosong')
                                                        ->body('Silakan masukkan kode mata kuliah terlebih dahulu.')
                                                        ->warning()
                                                        ->send();

                                                    return;
                                                }
                                                $data = Curriculum::lookupByCode($code);
                                                if ($data) {
                                                    $set('code', $data['code']);
                                                    $set('name.id', $data['name']);
                                                    $set('stage', $data['stage']);
                                                    $set('semester', $data['semester'] ?? null);
                                                    $set('academic_phase', $data['academic_phase'] ?? null);
                                                    $set('sks', $data['sks']);
                                                    $set('type', $data['type']);
                                                    $set('duration', $data['duration'] ?? null);
                                                    $set('location', $data['location'] ?? null);
                                                    $set('description.id', $data['description'] ?? null);
                                                    $set('api_id', $data['code']);

                                                    Notification::make()
                                                        ->title('Data Berhasil Diambil dari API')
                                                        ->body("Data [{$data['code']}] {$data['name']} berhasil diterapkan ke form.")
                                                        ->success()
                                                        ->send();
                                                } else {
                                                    Notification::make()
                                                        ->title('Kode Tidak Ditemukan di API')
                                                        ->body("Kode '{$code}' tidak ditemukan di repositori kurikulum API. Anda dapat mengisi form secara manual.")
                                                        ->warning()
                                                        ->send();
                                                }
                                            })
                                    )
                                    ->columnSpan(['default' => 12, 'lg' => 6]),
                            ]),
                    ]),

                Section::make('Informasi Blok & Kurikulum Kedokteran (Manual / Edit)')
                    ->columnSpanFull()
                    ->description('Kelola detail mata kuliah, bobot SKS, fase kurikulum, dan capaian pembelajaran.')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                TextInput::make('code')
                                    ->label('Kode Mata Kuliah / Blok')
                                    ->placeholder('Misal: KED101, ROT001')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->columnSpan(['default' => 12, 'md' => 4]),

                                Select::make('stage')
                                    ->label('Tahap Pendidikan')
                                    ->options(Curriculum::STAGES)
                                    ->default('sarjana')
                                    ->required()
                                    ->live()
                                    ->columnSpan(['default' => 12, 'md' => 4]),

                                Select::make('academic_phase')
                                    ->label('Fase Kurikulum')
                                    ->options(Curriculum::PHASES)
                                    ->default('Fase I')
                                    ->columnSpan(['default' => 12, 'md' => 4]),
                            ]),

                        TranslatableInput::text('name', 'Nama Blok / Mata Kuliah', required: true),

                        Grid::make(12)
                            ->schema([
                                TextInput::make('semester')
                                    ->label('Semester (Tahap Sarjana)')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(8)
                                    ->placeholder('1 - 8')
                                    ->helperText('Kosongkan bila merupakan tahap profesi (koas).')
                                    ->columnSpan(['default' => 12, 'md' => 3]),

                                TextInput::make('sks')
                                    ->label('Bobot SKS')
                                    ->numeric()
                                    ->required()
                                    ->default(4)
                                    ->minValue(1)
                                    ->maxValue(12)
                                    ->columnSpan(['default' => 12, 'md' => 3]),

                                Select::make('type')
                                    ->label('Tipe Pembelajaran / Stase')
                                    ->options(Curriculum::TYPES)
                                    ->default('Blok Inti')
                                    ->required()
                                    ->columnSpan(['default' => 12, 'md' => 3]),

                                TextInput::make('duration')
                                    ->label('Durasi Rotasi / Blok')
                                    ->placeholder('Misal: 6 Minggu, 10 Minggu')
                                    ->columnSpan(['default' => 12, 'md' => 3]),
                            ]),

                        Grid::make(12)
                            ->schema([
                                TextInput::make('location')
                                    ->label('Lokasi / Wahana Pembelajaran')
                                    ->placeholder('Misal: Kampus FK UBG, RSUD Praya, Puskesmas')
                                    ->columnSpan(['default' => 12, 'md' => 6]),

                                TextInput::make('api_id')
                                    ->label('ID / Referensi Sistem API Eksternal')
                                    ->placeholder('Misal: KED101-2024 atau SIAKAD-MK-409')
                                    ->columnSpan(['default' => 12, 'md' => 6]),
                            ]),

                        TranslatableInput::textarea('description', 'Deskripsi Capaian & Pokok Bahasan', required: false, rows: 3),

                        Grid::make(12)
                            ->schema([
                                TextInput::make('sort_order')
                                    ->label('Urutan Tampil')
                                    ->numeric()
                                    ->default(1)
                                    ->columnSpan(['default' => 12, 'md' => 6]),

                                Toggle::make('is_active')
                                    ->label('Aktif & Tampilkan di Halaman Publik')
                                    ->default(true)
                                    ->columnSpan(['default' => 12, 'md' => 6]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Kode')
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('name')
                    ->label('Nama Blok / Mata Kuliah')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('stage')
                    ->label('Jenjang')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'sarjana' => 'info',
                        'profesi' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'sarjana' => 'S1 Kedokteran',
                        'profesi' => 'Profesi (Koas)',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('semester')
                    ->label('Sem')
                    ->sortable()
                    ->alignCenter()
                    ->placeholder('-'),

                TextColumn::make('sks')
                    ->label('SKS')
                    ->sortable()
                    ->alignCenter()
                    ->suffix(' SKS'),

                TextColumn::make('type')
                    ->label('Tipe / Stase')
                    ->badge()
                    ->color('secondary')
                    ->sortable(),

                TextColumn::make('synced_at')
                    ->label('Status API')
                    ->dateTime('d M Y H:i')
                    ->placeholder('Manual')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->alignCenter(),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('stage')
                    ->label('Tahap Pendidikan')
                    ->options([
                        'sarjana' => 'Sarjana Kedokteran (S1)',
                        'profesi' => 'Profesi Dokter (dr.)',
                    ]),
                SelectFilter::make('semester')
                    ->label('Semester')
                    ->options([
                        1 => 'Semester 1',
                        2 => 'Semester 2',
                        3 => 'Semester 3',
                        4 => 'Semester 4',
                        5 => 'Semester 5',
                        6 => 'Semester 6',
                        7 => 'Semester 7',
                        8 => 'Semester 8',
                    ]),
                SelectFilter::make('type')
                    ->label('Tipe Blok / Stase')
                    ->options(Curriculum::TYPES),
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
            'index' => ListCurriculums::route('/'),
            'create' => CreateCurriculum::route('/create'),
            'edit' => EditCurriculum::route('/{record}/edit'),
        ];
    }
}
