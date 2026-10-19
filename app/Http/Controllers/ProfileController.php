<?php

namespace App\Http\Controllers;

use App\Models\FacultyMember;
use App\Models\OrganizationStructure;
use App\Models\SiteSetting;
use App\Models\VisionMission;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    /**
     * Display the official faculty profile page.
     */
    public function index(): View
    {
        $leadership = FacultyMember::active()
            ->withCategory('pimpinan')
            ->get();

        $defaults = VisionMission::getInitialDefaults();

        $facultyVisionMission = VisionMission::active()->fakultas()->first() ?? (object) $defaults['fakultas'];
        $prodiSarjanaVisionMission = VisionMission::active()->prodiSarjana()->first() ?? (object) $defaults['prodi_sarjana'];
        $prodiProfesiVisionMission = VisionMission::active()->prodiProfesi()->first() ?? (object) $defaults['prodi_profesi'];

        $organizationStructure = OrganizationStructure::active()->first();

        if (! $organizationStructure) {
            $siteSettingImg = SiteSetting::get('organization_structure_image');
            $organizationStructure = (object) [
                'title' => 'Struktur Organisasi Fakultas Kedokteran',
                'description' => 'Bagan tata kelola dan hierarki kepemimpinan Fakultas Kedokteran Universitas Bumigora.',
                'academic_period' => 'Periode 2024 - 2028',
                'image_url' => $siteSettingImg ?: 'images/structure/struktur-organisasi-fk-ubg.svg',
                'image_src' => $siteSettingImg ? (str_starts_with($siteSettingImg, 'http') ? $siteSettingImg : asset('storage/'.ltrim($siteSettingImg, '/'))) : asset('images/structure/struktur-organisasi-fk-ubg.svg'),
            ];
        }

        return view('pages.profile', compact(
            'leadership',
            'facultyVisionMission',
            'prodiSarjanaVisionMission',
            'prodiProfesiVisionMission',
            'organizationStructure'
        ));
    }
}
