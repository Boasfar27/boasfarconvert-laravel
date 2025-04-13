<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaticPage;
use Illuminate\Support\Facades\File;

class StaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Tentang Kami',
                'slug' => 'tentang-kami',
                'content' => $this->extractContentFromBlade('tentang-kami'),
                'meta_title' => 'Tentang Boasfar Convert - Konversi File Digital Terpercaya',
                'meta_description' => 'Pelajari lebih lanjut tentang Boasfar Convert, platform konversi file digital terkemuka yang menyediakan solusi konversi gambar dan dokumen yang cepat, aman, dan andal.',
                'last_updated_by' => 'Seeder',
            ],
            [
                'title' => 'Kebijakan Privasi',
                'slug' => 'kebijakan-privasi',
                'content' => $this->extractContentFromBlade('kebijakan-privasi'),
                'meta_title' => 'Kebijakan Privasi - Boasfar Convert',
                'meta_description' => 'Kebijakan privasi Boasfar Convert menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi yang Anda berikan saat menggunakan layanan kami.',
                'last_updated_by' => 'Seeder',
            ],
            [
                'title' => 'Syarat dan Ketentuan',
                'slug' => 'syarat-ketentuan',
                'content' => $this->extractContentFromBlade('syarat-ketentuan'),
                'meta_title' => 'Syarat dan Ketentuan - Boasfar Convert',
                'meta_description' => 'Pelajari syarat dan ketentuan penggunaan layanan Boasfar Convert, platform konversi file digital yang mudah dan aman digunakan.',
                'last_updated_by' => 'Seeder',
            ],
        ];

        foreach ($pages as $page) {
            StaticPage::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }

    /**
     * Extract content from blade file
     *
     * @param string $fileName
     * @return string
     */
    private function extractContentFromBlade($fileName): string
    {
        $path = resource_path("views/{$fileName}.blade.php");
        
        if (!File::exists($path)) {
            return "<p>Konten belum tersedia.</p>";
        }
        
        $content = File::get($path);
        
        // Cari area content-card
        if (preg_match('/<div class="content-card">(.*?)<\/div>\s*<\/div>\s*<\/div>\s*<\/div>/s', $content, $matches)) {
            return trim($matches[1]);
        }
        
        return "<p>Konten tidak dapat diekstraksi.</p>";
    }
}
