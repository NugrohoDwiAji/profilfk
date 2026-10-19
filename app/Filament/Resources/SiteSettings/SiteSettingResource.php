<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages\CreateSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\EditSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\ListSiteSettings;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Pengaturan Situs';

    protected static ?string $modelLabel = 'Pengaturan';

    protected static ?string $pluralModelLabel = 'Pengaturan Situs & Halaman';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kunci & Tipe Pengaturan')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('key')
                                    ->label('Kunci Pengaturan (Key)')
                                    ->required()
                                    ->disabled(fn ($record) => $record !== null)
                                    ->helperText('Contoh: tagline, campus_address, full_title, pmb_url, dll.'),
                                Select::make('type')
                                    ->label('Tipe Nilai')
                                    ->options([
                                        'text' => 'Teks Multi-Bahasa / Biasa',
                                        'textarea' => 'Teks Panjang',
                                        'url' => 'Tautan / URL',
                                        'email' => 'Alamat Email',
                                        'phone' => 'Nomor Telepon',
                                    ])
                                    ->default('text')
                                    ->required(),
                            ]),
                    ]),

                Section::make('Nilai Pengaturan (3 Bahasa)')
                    ->description('Untuk teks yang tampil ke publik (tagline, alamat, dll), gunakan input 3 bahasa.')
                    ->schema([
                        Fieldset::make('Terjemahan 3 Bahasa (Opsional)')
                            ->schema([
                                TextInput::make('value_id')
                                    ->label('🇮🇩 Bahasa Indonesia'),
                                TextInput::make('value_en')
                                    ->label('🇬🇧 English'),
                                TextInput::make('value_zh')
                                    ->label('🇨🇳 中文 (Mandarin)'),
                            ])
                            ->columns(3),

                        Textarea::make('value')
                            ->label('Nilai Tunggal / URL / Non-Bahasa (Fallback)')
                            ->rows(2)
                            ->helperText('Diisi jika pengaturan berupa URL, nomor telepon, atau nilai tunggal tanpa terjemahan.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Kunci')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value')
                    ->label('Nilai Pengaturan')
                    ->limit(60)
                    ->tooltip(fn ($record): string => (string) $record->value),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color('info'),
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
            'index' => ListSiteSettings::route('/'),
            'create' => CreateSiteSetting::route('/create'),
            'edit' => EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
