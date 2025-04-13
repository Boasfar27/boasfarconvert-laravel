<?php

namespace App\Http\Controllers;

use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    /**
     * Display the specified static page.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = StaticPage::findBySlug($slug)->first();
        
        if (!$page) {
            abort(404);
        }
        
        return view('static-pages.show', compact('page'));
    }
}
