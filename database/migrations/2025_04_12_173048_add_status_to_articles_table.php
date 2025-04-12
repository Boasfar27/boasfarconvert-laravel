<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('status')->default(Article::STATUS_DRAFT)->after('is_published');
        });
        
        // Update existing articles with appropriate status
        DB::statement("
            UPDATE articles 
            SET status = CASE
                WHEN is_published = 1 AND published_at <= NOW() THEN '" . Article::STATUS_PUBLISHED . "'
                WHEN is_published = 1 AND published_at > NOW() THEN '" . Article::STATUS_SCHEDULED . "'
                ELSE '" . Article::STATUS_DRAFT . "'
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
