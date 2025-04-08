<?php

namespace App\Providers;

use App\Models\FooterSection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share footer sections with all views
        View::composer('partials.footer', function ($view) {
            $footerSections = FooterSection::active()->get()->groupBy('slug');
            $view->with('footerSections', $footerSections);
        });
    }
}
