<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PublishScheduledArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-scheduled-articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mempublikasikan artikel yang sudah dijadwalkan dan waktunya telah tiba';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memeriksa artikel yang terjadwal...');
        
        $articles = Article::where('status', Article::STATUS_SCHEDULED)
            ->where('is_published', true)
            ->where('published_at', '<=', now())
            ->get();
            
        if ($articles->isEmpty()) {
            $this->info('Tidak ada artikel terjadwal yang perlu dipublikasikan.');
            return 0;
        }
        
        $count = 0;
        foreach ($articles as $article) {
            $article->status = Article::STATUS_PUBLISHED;
            $article->save();
            
            $publishTime = $article->published_at->setTimezone('Asia/Jakarta')->format('d M Y H:i');
            $this->info("Artikel \"{$article->title}\" berhasil dipublikasikan (jadwal: {$publishTime}).");
            Log::info("Artikel terjadwal berhasil dipublikasikan: {$article->title} (ID: {$article->id}) - Jadwal: {$publishTime}");
            $count++;
        }
        
        $this->info("Total {$count} artikel berhasil dipublikasikan.");
        return 0;
    }
}
