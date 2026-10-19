<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Display the official contact page.
     */
    public function index(): View
    {
        return view('pages.contact');
    }

    /**
     * Store a newly submitted contact message.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['ip_address'] = $request->ip();

        ContactMessage::create($validated);

        return back()->with('success', 'Pesan Anda berhasil terkirim! Tim admisi dan sekretariat Fakultas Kedokteran UBG akan segera menghubungi Anda.');
    }
}
