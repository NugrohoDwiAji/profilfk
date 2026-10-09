<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    /**
     * Display the specified news article.
     */
    public function show(string $slug): View
    {
        $article = News::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views
        $article->increment('views_count');

        $relatedNews = News::published()
            ->where('id', '!=', $article->id)
            ->take(3)
            ->get();

        $settings = SiteSetting::pluck('value', 'key')->all();

        return view('pages.news-detail', compact('article', 'relatedNews', 'settings'));
    }
}
