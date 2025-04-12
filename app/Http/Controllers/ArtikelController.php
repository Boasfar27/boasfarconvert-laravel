<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index(Request $request)
    {
        $category = $request->get('category');
        
        $query = Article::published()->with('author');
        
        if ($category) {
            $query->where('category', $category);
        }
        
        $articles = $query->orderBy('published_at', 'desc')
            ->paginate(9);
            
        $categories = Article::published()
            ->select('category')
            ->distinct()
            ->pluck('category');
            
        return view('artikel.index', compact('articles', 'categories', 'category'));
    }

    /**
     * Display the specified article.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->published()
            ->with('author')
            ->firstOrFail();
            
        // Increment view count
        $article->increment('views');
        
        // Get related articles
        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where(function($query) use ($article) {
                return $query->where('category', $article->category)
                    ->orWhere('user_id', $article->user_id);
            })
            ->limit(3)
            ->orderBy('published_at', 'desc')
            ->get();
            
        return view('artikel.show', compact('article', 'relatedArticles'));
    }
} 