<?php

namespace App\Filament\Resources\Programs;

use App\Filament\Forms\Components\TranslatableInput;
use App\Filament\Resources\Programs\Pages\CreateProgram;
use App\Filament\Resources\Programs\Pages\EditProgram;
use App\Filament\Resources\Programs\Pages\ListPrograms;
use App\Models\Program;
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

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'Program Studi';

    protected static ?string $modelLabel = 'Program Studi';

    protected static ?string $pluralModelLabel = 'Program Studi';

    protected static string|UnitEnum|null $navigationGroup = 'Konten Publik';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informasi Program Studi (3 Bahasa)')
                    ->columnSpanFull()
                    ->description('Kelola detail program studi kedokteran, jenjang, foto sampul, dan kurikulum dalam 3 bahasa.')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                FileUpload::make('image_url')
                                    ->label('Foto / Gambar Sampul Program Studi')
                                    ->image()
                                    ->imageEditor()
                                    ->imageCropAspectRatio('16:9')
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '16:10',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->directory('programs')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->maxSize(5120)
                                    ->helperText('Unggah foto sampul program studi (JPG/PNG/WebP, disarankan rasio lanskap 16:9 atau 16:10 sesuai tampilan kartu di halaman depan, maks. 5MB).')
                                    ->columnSpan(['default' => 12, 'lg' => 5]),

                                Grid::make(1)
                                    ->schema([
                                        TranslatableInput::text('name', 'Nama Program Studi', required: true),

                                        Grid::make(3)
                                            ->schema([
                                                TextInput::make('degree')
                                                    ->label('Jenjang Pendidikan')
                                                    ->placeholder('S1 / Profesi')
                                                    ->required(),
                                                TextInput::make('slug')
                                                    ->required()
                                                    ->unique(ignoreRecord: true),
                                                TextInput::make('degree_title')
                                                    ->label('Gelar Kelulusan')
                                                    ->placeholder('S.Ked / dr.')
                                                    ->required(),
                                            ]),

                                        Grid::make(3)
                                            ->schema([
                                                TextInput::make('duration_semesters')
                                                    ->numeric()
                                                    ->default(8)
                                                    ->label('Masa Studi (Semester)')
                                                    ->required(),
                                                TextInput::make('accreditation')
                                                    ->label('Status Akreditasi')
                                                    ->default('Terakreditasi LAM-PTKes'),
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

                        TranslatableInput::text('tagline', 'Tagline / Slogan Program', required: false),

                        TranslatableInput::textarea('description', 'Deskripsi Lengkap Program', required: true, rows: 4),

                        TranslatableInput::textarea('curriculum_summary', 'Ringkasan Kurikulum & SKS', required: false, rows: 4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Foto / Sampul')
                    ->checkFileExistence(false)
                    ->state(fn (Program $record): ?string => $record->image_src)
                    ->height(48)
                    ->width(80)
                    ->extraImgAttributes(['class' => 'object-cover rounded-lg shadow-2xs border border-steel-200/80']),

                TextColumn::make('name')
                    ->label('Program Studi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('degree')
                    ->label('Jenjang')
                    ->badge()
                    ->color('info'),

                TextColumn::make('degree_title')
                    ->label('Gelar'),

                TextColumn::make('duration_semesters')
                    ->label('Durasi')
                    ->suffix(' Semester'),

                TextColumn::make('accreditation')
                    ->label('Akreditasi')
                    ->badge()
                    ->color('success'),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('sort_order')
                    ->label('Urutan')
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
            'index' => ListPrograms::route('/'),
            'create' => CreateProgram::route('/create'),
            'edit' => EditProgram::route('/{record}/edit'),
        ];
    }
}
