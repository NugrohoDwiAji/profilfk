<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacultyMember;
use App\Models\News;
use App\Models\Program;
use App\Models\ResearchProject;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the official landing page for Fakultas Kedokteran Universitas Bumigora.
     */
    public function index(): View
    {
        $programs = Program::active()->get();
        $facultyMembers = FacultyMember::active()->get();
        $news = News::published()->take(4)->get();
        $researches = ResearchProject::published()->take(3)->get();
        $facilities = Facility::active()->get();

        // Key-value settings map
        $settings = SiteSetting::pluck('value', 'key')->all();

        return view('pages.home', compact(
            'programs',
            'facultyMembers',
            'news',
            'researches',
            'facilities',
            'settings'
        ));
    }
}
