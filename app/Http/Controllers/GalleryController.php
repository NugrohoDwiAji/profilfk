<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display the official public gallery page.
     */
    public function index(Request $request): View
    {
        $query = Gallery::active();

        if ($request->filled('category') && $request->query('category') !== 'all') {
            $query->where('category', $request->query('category'));
        }

        $galleries = $query->paginate(12)->withQueryString();
        $categories = array_keys(Gallery::CATEGORIES);

        return view('pages.gallery', compact('galleries', 'categories'));
    }
}
