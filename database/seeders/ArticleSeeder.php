<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user
        $admin = User::where('role', User::ROLE_ADMIN)->first();
        
        if (!$admin) {
            $admin = User::first();
        }
        
        if (!$admin) {
            return;
        }
        
        $articles = [
            [
                'title' => 'Keunggulanm Format WebP untuk Website Modern',
                'excerpt' => '<p>Format WebP adalah format gambar modern yang dikembangkan oleh Google. Format ini menawarkan kompresi yang lebih baik dibandingkan JPEG dan PNG.</p>',
                'content' => '<p>Format WebP adalah format gambar modern yang dikembangkan oleh Google. Format ini menawarkan kompresi yang lebih baik dibandingkan format JPEG dan PNG tradisional, sehingga menghasilkan file yang lebih kecil tanpa mengorbankan kualitas gambar secara signifikan.</p>

<h2>Keunggulan Format WebP</h2>

<p>Berikut adalah beberapa keunggulan format WebP yang perlu Anda ketahui:</p>

<h3>1. Ukuran File Lebih Kecil</h3>

<p>Format WebP dapat menghasilkan gambar dengan ukuran file yang 25-34% lebih kecil dibandingkan JPEG dan PNG dengan kualitas visual yang sama. Hal ini sangat penting untuk kecepatan loading website.</p>

<h3>2. Mendukung Transparansi</h3>

<p>Berbeda dengan JPEG, format WebP mendukung transparansi seperti PNG, namun dengan ukuran file yang jauh lebih kecil.</p>

<h3>3. Mendukung Animasi</h3>

<p>WebP juga mendukung animasi, mirip dengan format GIF, tetapi dengan ukuran file yang jauh lebih kecil dan kualitas yang lebih baik.</p>

<h2>Manfaat WebP untuk Website</h2>

<ul>
    <li>Mempercepat waktu loading website</li>
    <li>Menghemat bandwidth</li>
    <li>Meningkatkan peringkat SEO (Google memprioritaskan website yang cepat)</li>
    <li>Mengurangi bounce rate pengunjung</li>
</ul>

<p>Dengan mengkonversi gambar JPEG dan PNG ke format WebP, Anda dapat secara signifikan meningkatkan performa website Anda. Boasfar Convert menyediakan layanan konversi gambar ke format WebP dengan kualitas tinggi dan hasil yang optimal.</p>',
                'category' => 'Konversi Gambar',
                'published_at' => now()->subDays(2),
                'is_published' => true,
            ],
            [
                'title' => 'Mengapa Konversi PDF ke Word Penting untuk Produktivitas',
                'excerpt' => '<p>Kemampuan mengedit dokumen PDF dengan mengkonversinya ke format Word sangat penting untuk efisiensi kerja. Fitur ini memungkinkan editing tanpa harus mengetik ulang.</p>',
                'content' => '<p>PDF (Portable Document Format) adalah format dokumen yang sangat populer dan banyak digunakan untuk berbagi dokumen. Namun, salah satu batasan utama PDF adalah sifatnya yang sulit diedit. Inilah mengapa konversi PDF ke Word menjadi sangat penting dalam dunia kerja modern.</p>

<h2>Mengapa Perlu Mengkonversi PDF ke Word?</h2>

<h3>1. Kemudahan Pengeditan</h3>

<p>Microsoft Word menawarkan lingkungan pengeditan yang familiar dan lengkap. Mengkonversi PDF ke Word memungkinkan Anda melakukan perubahan pada konten dengan mudah.</p>

<h3>2. Efisiensi Waktu</h3>

<p>Daripada mengetik ulang seluruh dokumen, konversi PDF ke Word memungkinkan Anda mengedit dokumen yang sudah ada, menghemat banyak waktu dan usaha.</p>

<h3>3. Mempertahankan Formatisasi</h3>

<p>Konverter PDF ke Word yang baik dapat mempertahankan sebagian besar formatisasi dokumen asli, termasuk font, gambar, tabel, dan layout.</p>

<h2>Kasus Penggunaan Umum</h2>

<ul>
    <li>Mengedit kontrak dan dokumen legal yang diterima dalam format PDF</li>
    <li>Memperbarui dokumen lama yang hanya tersedia dalam format PDF</li>
    <li>Mengekstrak dan menggunakan kembali konten dari dokumen PDF</li>
    <li>Menyesuaikan dan mempersonalisasi template dokumen</li>
</ul>

<h2>Tips untuk Konversi PDF ke Word yang Optimal</h2>

<ol>
    <li>Gunakan alat konversi berkualitas tinggi seperti Boasfar Convert</li>
    <li>Pastikan PDF sumber memiliki kualitas yang baik</li>
    <li>Untuk dokumen yang kompleks, periksa hasil konversi dengan teliti</li>
    <li>Perhatikan terutama tabel dan elemen grafis setelah konversi</li>
</ol>

<p>Boasfar Convert menyediakan layanan konversi PDF ke Word dengan akurasi tinggi. Cobalah sekarang untuk meningkatkan produktivitas kerja Anda!</p>',
                'category' => 'Konversi PDF',
                'published_at' => now()->subDays(3),
                'is_published' => true,
            ],
            [
                'title' => 'Teknik Mengoptimalkan Ukuran File Gambar Tanpa Mengorbankan Kualitas',
                'excerpt' => '<p>Optimasi gambar adalah kunci performance website. Pelajari cara mengurangi ukuran file tanpa mengorbankan kualitas visual untuk pengalaman pengguna yang lebih baik.</p>',
                'content' => '<p>Gambar merupakan salah satu faktor utama yang mempengaruhi kecepatan loading website. Optimasi gambar yang tepat dapat secara dramatis meningkatkan performa website Anda tanpa mengorbankan kualitas visual.</p>

<h2>Mengapa Optimasi Gambar Penting?</h2>

<p>Website yang memuat dengan cepat tidak hanya memberikan pengalaman pengguna yang lebih baik, tetapi juga berdampak positif pada:</p>

<ul>
    <li>Peringkat SEO yang lebih tinggi</li>
    <li>Bounce rate yang lebih rendah</li>
    <li>Konversi yang lebih baik</li>
    <li>Penggunaan data yang lebih efisien untuk pengguna mobile</li>
</ul>

<h2>Teknik Optimasi Gambar Efektif</h2>

<h3>1. Pilih Format File yang Tepat</h3>

<p>Format gambar yang berbeda cocok untuk jenis konten yang berbeda:</p>

<ul>
    <li><strong>WebP</strong>: Format modern dengan kompresi terbaik untuk web</li>
    <li><strong>JPEG</strong>: Ideal untuk foto dengan banyak warna</li>
    <li><strong>PNG</strong>: Cocok untuk gambar dengan transparansi</li>
    <li><strong>SVG</strong>: Sempurna untuk logo dan ikon yang dapat diskalakan</li>
</ul>

<h3>2. Kompresi yang Cerdas</h3>

<p>Gunakan kompresi "lossy" untuk pengurangan ukuran file yang dramatis dengan sedikit pengurangan kualitas visual yang hampir tidak terlihat.</p>

<h3>3. Resize Gambar Sesuai Kebutuhan</h3>

<p>Jangan menampilkan gambar 2000x1500 pixel jika area tampilan hanya 600x400 pixel. Selalu resize gambar sesuai ukuran tampilan maksimum yang dibutuhkan.</p>

<h3>4. Gunakan Lazy Loading</h3>

<p>Teknik ini menunda loading gambar sampai pengguna menggulir ke bawah dan hampir melihatnya di layar.</p>

<h3>5. Hapus Metadata yang Tidak Perlu</h3>

<p>Gambar sering menyimpan metadata seperti informasi EXIF dari kamera, yang dapat dihapus untuk pengurangan ukuran file.</p>

<h2>Alat Optimasi Gambar</h2>

<p>Boasfar Convert menyediakan layanan konversi gambar ke WebP yang secara otomatis mengoptimalkan gambar Anda. Selain itu, Anda juga dapat menggunakan:</p>

<ul>
    <li>ImageOptim (Mac)</li>
    <li>FileOptimizer (Windows)</li>
    <li>Squoosh (Web App)</li>
</ul>

<p>Dengan menerapkan teknik optimasi gambar ini, Anda dapat mengurangi ukuran file hingga 70% tanpa penurunan kualitas visual yang berarti.</p>',
                'category' => 'Tips & Trik',
                'published_at' => now()->subDays(5),
                'is_published' => true,
            ],
        ];
        
        foreach ($articles as $article) {
            Article::create([
                'user_id' => $admin->id,
                'title' => $article['title'],
                'slug' => Str::slug($article['title']),
                'excerpt' => $article['excerpt'],
                'content' => $article['content'],
                'category' => $article['category'],
                'published_at' => $article['published_at'],
                'is_published' => $article['is_published'],
                'views' => rand(10, 100),
            ]);
        }
    }
} 