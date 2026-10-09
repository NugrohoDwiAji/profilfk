<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;

class ProgramController extends Controller
{
    /**
     * Display the specified academic program.
     */
    public function show(string $slug): View
    {
        $program = Program::active()
            ->where('slug', $slug)
            ->firstOrFail();

        $allPrograms = Program::active()
            ->where('id', '!=', $program->id)
            ->get();

        $settings = SiteSetting::pluck('value', 'key')->all();

        return view('pages.program-detail', compact('program', 'allPrograms', 'settings'));
    }
}
