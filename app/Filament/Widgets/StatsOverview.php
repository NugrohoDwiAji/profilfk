<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\Facility;
use App\Models\FacultyMember;
use App\Models\News;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $publishedNews = News::where('status', 'published')->count();
        $totalViews = (int) News::sum('views_count');
        $activeFaculty = FacultyMember::where('is_active', true)->count();
        $leadershipCount = FacultyMember::withCategory('pimpinan')->count();
        $activeFacilities = Facility::where('is_active', true)->count();

        return [
            Stat::make('Pesan Masuk Baru', $unreadMessages)
                ->description($unreadMessages > 0 ? "{$unreadMessages} pesan belum dibaca" : 'Semua pesan tertangani')
                ->descriptionIcon($unreadMessages > 0 ? Heroicon::OutlinedExclamationCircle : Heroicon::OutlinedCheckCircle)
                ->color($unreadMessages > 0 ? 'danger' : 'success')
                ->url(url('/admin/contact-messages')),

            Stat::make('Berita Terpublikasi', $publishedNews)
                ->description(number_format($totalViews).' pembaca publik')
                ->descriptionIcon(Heroicon::OutlinedEye)
                ->color('info')
                ->url(url('/admin/news')),

            Stat::make('Dosen & Tenaga Ahli', $activeFaculty)
                ->description("{$leadershipCount} pimpinan & spesialis")
                ->descriptionIcon(Heroicon::OutlinedAcademicCap)
                ->color('success')
                ->url(url('/admin/faculty-members')),

            Stat::make('Fasilitas & Laboratorium', $activeFacilities)
                ->description("{$activeFacilities} lab & sarana aktif")
                ->descriptionIcon(Heroicon::OutlinedBuildingOffice2)
                ->color('primary')
                ->url(url('/admin/facilities')),
        ];
    }
}
