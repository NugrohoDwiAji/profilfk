<?php

namespace App\Filament\Resources\VisionMissions;

use App\Filament\Forms\Components\TranslatableInput;
use App\Filament\Resources\VisionMissions\Pages\CreateVisionMission;
use App\Filament\Resources\VisionMissions\Pages\EditVisionMission;
use App\Filament\Resources\VisionMissions\Pages\ListVisionMissions;
use App\Models\VisionMission;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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

class VisionMissionResource extends Resource
{
    protected static ?string $model = VisionMission::class;

    protected static ?string $slug = 'vision-missions';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLightBulb;

    protected static ?string $navigationLabel = 'Visi & Misi';

    protected static ?string $modelLabel = 'Visi & Misi';

    protected static ?string $pluralModelLabel = 'Visi & Misi Institusi & Prodi';

    protected static string|UnitEnum|null $navigationGroup = 'Konten Publik';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informasi & Tingkat Visi Misi')
                    ->columnSpanFull()
                    ->description('Tentukan tingkat entitas akademik (Fakultas atau Program Studi) dan status publikasi.')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                Select::make('scope')
                                    ->label('Tingkat / Sasaran')
                                    ->options(VisionMission::SCOPES)
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->columnSpan(['default' => 12, 'md' => 5]),

                                Select::make('theme_color')
                                    ->label('Tema Warna Kartu')
                                    ->options(VisionMission::THEME_COLORS)
                                    ->default('blue')
                                    ->required()
                                    ->columnSpan(['default' => 12, 'md' => 3]),

                                TextInput::make('sort_order')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->default(1)
                                    ->columnSpan(['default' => 12, 'md' => 2]),

                                Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true)
                                    ->columnSpan(['default' => 12, 'md' => 2]),
                            ]),

                        TranslatableInput::text('name', 'Nama Entitas / Program', required: true),
                    ]),

                Section::make('Pernyataan Visi (3 Bahasa & Poin Keunggulan)')
                    ->columnSpanFull()
                    ->description('Kelola teks visi, label penanda, judul visi, serta poin-poin keunggulan institusi.')
                    ->schema([
                        TranslatableInput::text('eyebrow', 'Label Penanda Visi (Misal: VISI FAKULTAS KEDOKTERAN)', required: true),

                        TranslatableInput::text('vision_title', 'Judul / Slogan Utama Visi', required: true),

                        TranslatableInput::textarea('vision', 'Pernyataan Lengkap Visi', required: true, rows: 3),

                        TagsInput::make('highlights')
                            ->label('Poin Highlight Keunggulan (Ketik lalu tekan Enter)')
                            ->placeholder('Tambah highlight baru...')
                            ->helperText('Contoh: Pendidikan Kedokteran Unggul, Kedokteran Tropis, Bioetika & Humanisme.'),
                    ]),

                Section::make('Misi Strategis (Daftar Terstruktur)')
                    ->columnSpanFull()
                    ->description('Kelola label misi dan butir-butir misi tridharma perguruan tinggi.')
                    ->schema([
                        TranslatableInput::text('mission_title', 'Judul / Label Seksi Misi (Misal: MISI STRATEGIS FAKULTAS)', required: true),

                        Repeater::make('missions')
                            ->label('Daftar Butir Misi')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Butir Misi')
                                    ->placeholder('Misal: Pendidikan Terintegrasi & Berpusat pada Mahasiswa')
                                    ->required(),
                                Textarea::make('description')
                                    ->label('Uraian / Penjelasan Misi')
                                    ->placeholder('Tuliskan rincian penjelasan pelaksanaan butir misi ini...')
                                    ->rows(2)
                                    ->required(),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Butir Misi Baru')
                            ->defaultItems(4)
                            ->addActionLabel('Tambah Butir Misi Baru'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Entitas')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('scope')
                    ->label('Tingkat')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'fakultas' => 'primary',
                        'prodi_sarjana' => 'info',
                        'prodi_profesi' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'fakultas' => 'Fakultas Kedokteran',
                        'prodi_sarjana' => 'S1 Kedokteran',
                        'prodi_profesi' => 'Profesi Dokter',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('vision_title')
                    ->label('Judul Visi')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('missions_count')
                    ->label('Jumlah Misi')
                    ->badge()
                    ->color('secondary')
                    ->state(fn (VisionMission $record): string => count($record->missions ?? []).' Misi'),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->alignCenter(),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('scope')
                    ->label('Tingkat')
                    ->options(VisionMission::SCOPES),
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
            'index' => ListVisionMissions::route('/'),
            'create' => CreateVisionMission::route('/create'),
            'edit' => EditVisionMission::route('/{record}/edit'),
        ];
    }
}
