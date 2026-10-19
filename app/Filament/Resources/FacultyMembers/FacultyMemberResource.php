<?php

namespace App\Filament\Resources\FacultyMembers;

use App\Filament\Forms\Components\TranslatableInput;
use App\Filament\Resources\FacultyMembers\Pages\CreateFacultyMember;
use App\Filament\Resources\FacultyMembers\Pages\EditFacultyMember;
use App\Filament\Resources\FacultyMembers\Pages\ListFacultyMembers;
use App\Models\FacultyMember;
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
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class FacultyMemberResource extends Resource
{
    protected static ?string $model = FacultyMember::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $navigationLabel = 'Dosen & Tenaga Ahli';

    protected static ?string $modelLabel = 'Dosen';

    protected static ?string $pluralModelLabel = 'Dosen & Tenaga Ahli';

    protected static string|UnitEnum|null $navigationGroup = 'Konten Publik';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Identitas Dosen (3 Bahasa)')
                    ->columnSpanFull()
                    ->description('Kelola data profil staf pengajar, dokter spesialis, dan pimpinan fakultas.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                FileUpload::make('photo_url')
                                    ->label('Foto Resmi Dosen')
                                    ->image()
                                    ->imageEditor()
                                    ->imageCropAspectRatio('1:1')
                                    ->directory('faculty')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->helperText('Unggah foto resmi dosen (JPG/PNG/WebP, rasio 1:1 persegi).')
                                    ->columnSpan(1),

                                Grid::make(1)
                                    ->schema([
                                        TranslatableInput::text('name', 'Nama Lengkap & Gelar', required: true),
                                        TranslatableInput::text('academic_title', 'Gelar Akademik Singkat', required: false),
                                    ])
                                    ->columnSpan(2),
                            ]),

                        Grid::make(4)
                            ->schema([
                                Select::make('category')
                                    ->label('Kategori Jabatan')
                                    ->options(FacultyMember::CATEGORIES)
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->columnSpan(2),
                                TextInput::make('nik')
                                    ->label('NIK / NIDN')
                                    ->placeholder('0819027801'),
                                TextInput::make('email')
                                    ->email()
                                    ->placeholder('nama@fk.bumigora.ac.id'),
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

                        TranslatableInput::text('specialization', 'Bidang Keahlian / Spesialisasi Medis', required: false),

                        TranslatableInput::text('department', 'Departemen / Bagian', required: false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_url')
                    ->label('Foto')
                    ->square()
                    ->checkFileExistence(false)
                    ->state(function (FacultyMember $record): ?string {
                        if (! $record->photo_url) {
                            return null;
                        }

                        if (str_starts_with($record->photo_url, 'http://') || str_starts_with($record->photo_url, 'https://')) {
                            return $record->photo_url;
                        }

                        $cleaned = ltrim($record->photo_url, '/');

                        if (file_exists(public_path($cleaned))) {
                            return asset($cleaned);
                        }

                        return asset('storage/'.$cleaned);
                    }),
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nik')
                    ->label('NIK / NIDN')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => FacultyMember::CATEGORIES[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        'pimpinan' => 'primary',
                        'dosen_spesialis' => 'info',
                        'dosen_biomedik' => 'success',
                        'pakar_med_ed' => 'warning',
                        'bioetik_medikolegal' => 'danger',
                        'komunitas_pencegahan' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('specialization')
                    ->label('Spesialisasi')
                    ->limit(25),
                TextColumn::make('email')
                    ->label('Email'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Filter Kategori')
                    ->options(FacultyMember::CATEGORIES)
                    ->query(function (Builder $query, array $data): Builder {
                        if (blank($data['value'] ?? null)) {
                            return $query;
                        }

                        $val = $data['value'];

                        return $query->where(function (Builder $q) use ($val) {
                            $q->whereJsonContains('category', $val)
                                ->orWhere('category', 'like', '%"'.$val.'"%');
                        });
                    }),
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
            'index' => ListFacultyMembers::route('/'),
            'create' => CreateFacultyMember::route('/create'),
            'edit' => EditFacultyMember::route('/{record}/edit'),
        ];
    }
}
