<?php

namespace App\Http\Controllers;

use App\Models\FacultyMember;
use Illuminate\Contracts\View\View;

class FacultyController extends Controller
{
    /**
     * Display the official faculty members & lecturers page.
     */
    public function index(): View
    {
        $facultyMembers = FacultyMember::active()->get();

        return view('pages.faculty', compact('facultyMembers'));
    }
}
