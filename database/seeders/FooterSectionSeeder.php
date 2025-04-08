<?php

namespace Database\Seeders;

use App\Models\FooterSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'title' => 'Tentang Kami',
                'slug' => 'tentang-kami',
                'content' => '<p>Solusi konversi gambar dan dokumen profesional dengan performa tinggi.</p>',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Fitur',
                'slug' => 'fitur',
                'content' => '<a href="/convert/image">Konversi Gambar</a>
                    <a href="/convert/pdf-to-word">PDF ke Word</a>
                    <a href="/convert/word-to-pdf">Word ke PDF</a>
                    <a href="/premium">Premium Akses</a>',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Tentang',
                'slug' => 'tentang',
                'content' => '<a href="/tentang-kami">Tentang Kami</a>
                    <a href="/blog">Blog</a>
                    <a href="/kebijakan-privasi">Kebijakan Privasi</a>
                    <a href="/syarat-ketentuan">Syarat & Ketentuan</a>',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Hubungi Kami',
                'slug' => 'hubungi-kami',
                'content' => '<a href="mailto:info@boasfarconvert.com" class="contact-item">
                    <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    info@boasfarconvert.com
                </a>
                <a href="tel:+6281234567890" class="contact-item">
                    <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    +62-812-3456-7890
                </a>',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            FooterSection::updateOrCreate(
                ['slug' => $section['slug']],
                $section
            );
        }
    }
} 