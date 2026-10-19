<?php

namespace App\Filament\Resources\Curriculums\Pages;

use App\Filament\Resources\Curriculums\CurriculumResource;
use App\Models\Curriculum;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListCurriculums extends ListRecords
{
    protected static string $resource = CurriculumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sync_api')
                ->label('Sinkronisasi dari API')
                ->icon(Heroicon::OutlinedArrowPath)
                ->color('warning')
                ->modalHeading('Sinkronisasi Kurikulum & Blok dari API')
                ->modalDescription('Tarik dan perbarui struktur kurikulum dari repositori API atau standar nasional (SKDI / SNPPDI).')
                ->form([
                    Select::make('preset')
                        ->label('Pilihan Sumber API')
                        ->options([
                            'demo_medical_skdi' => 'Standar Nasional Kurikulum Kedokteran (SKDI / SNPPDI 2024)',
                            'siakad_ubg' => 'SIAKAD Universitas Bumigora (API Akademik Terpadu)',
                            'custom_url' => 'Custom REST API (URL Eksternal)',
                        ])
                        ->default('demo_medical_skdi')
                        ->required()
                        ->live(),

                    TextInput::make('custom_url')
                        ->label('URL Endpoint REST API')
                        ->placeholder('https://api.universitasbumigora.ac.id/v1/curriculum')
                        ->visible(fn ($get) => $get('preset') === 'custom_url')
                        ->required(fn ($get) => $get('preset') === 'custom_url'),

                    TextInput::make('token')
                        ->label('Bearer Token Autentikasi (Opsional)')
                        ->password()
                        ->placeholder('Bearer eyJhbGciOi...')
                        ->visible(fn ($get) => $get('preset') === 'custom_url'),
                ])
                ->action(function (array $data): void {
                    $result = Curriculum::syncFromApi(
                        $data['preset'] ?? 'demo_medical_skdi',
                        $data['custom_url'] ?? null,
                        $data['token'] ?? null
                    );

                    if ($result['success']) {
                        Notification::make()
                            ->title('Sinkronisasi API Berhasil')
                            ->body($result['message'])
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Gagal Sinkronisasi API')
                            ->body($result['message'])
                            ->danger()
                            ->send();
                    }
                }),

            CreateAction::make()
                ->label('Tambah Blok Manual'),
        ];
    }
}
