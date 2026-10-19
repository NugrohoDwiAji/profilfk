<?php

namespace App\Http\Controllers;

use App\Models\TeachingHospital;
use Illuminate\Contracts\View\View;

class HospitalController extends Controller
{
    /**
     * Display the official teaching hospitals and clinical network page.
     */
    public function index(): View
    {
        $hospitals = TeachingHospital::active()->get();
        $mainHospital = $hospitals->firstWhere('type', 'utama') ?? $hospitals->first();
        $networkHospitals = $hospitals->where('id', '!=', $mainHospital?->id);

        return view('pages.hospital', compact('hospitals', 'mainHospital', 'networkHospitals'));
    }
}
