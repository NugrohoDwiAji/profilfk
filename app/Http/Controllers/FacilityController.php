<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Contracts\View\View;

class FacilityController extends Controller
{
    /**
     * Display the official facilities page.
     */
    public function index(): View
    {
        $facilities = Facility::active()->get();

        return view('pages.facilities', compact('facilities'));
    }
}
