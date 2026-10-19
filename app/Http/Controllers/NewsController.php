<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of published news and announcements.
     */
    public function index(Request $request): View
    {
        $query = News::published();

        if ($request->filled('category') && $request->query('category') !== 'all') {
            $query->where('category', $request->query('category'));
        }

        if ($request->filled('q')) {
            $search = (string) $request->query('q');
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $news = $query->paginate(9)->withQueryString();
        $categories = News::published()->pluck('category')->unique()->filter()->values();

        return view('pages.news', compact('news', 'categories'));
    }

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

        $settings = SiteSetting::allMap();

        return view('pages.news-detail', compact('article', 'relatedNews', 'settings'));
    }
}
