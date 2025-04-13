<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(ViewServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Jika menjalankan di HTTPS, paksa URL HTTPS
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            URL::forceScheme('https');
        }
        
        // Daftarkan disk publik alternatif untuk hosting tanpa symlink
        Storage::extend('public_direct', function ($app, $config) {
            $config['root'] = public_path('storage');
            
            // Pastikan direktori storage ada di public
            if (!file_exists(public_path('storage'))) {
                mkdir(public_path('storage'), 0755, true);
            }
            
            // Buat subdirektori penting
            $directories = [
                'article-thumbnails',
                'article-attachments',
            ];
            
            foreach ($directories as $dir) {
                if (!file_exists(public_path('storage/' . $dir))) {
                    mkdir(public_path('storage/' . $dir), 0755, true);
                }
            }
            
            return $app->make('filesystem')->createLocalDriver($config);
        });
    }
}
