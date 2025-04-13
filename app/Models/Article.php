<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory;

    // Article status constants
    const STATUS_DRAFT = 'draft';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'excerpt',
        'content',
        'category',
        'published_at',
        'is_published',
        'status',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    /**
     * Get the author who wrote the article
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Generate slug from title
     */
    public static function booted()
    {
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
            
            // Set default status if not provided
            if (empty($article->status)) {
                $article->status = self::STATUS_DRAFT;
            }
        });
        
        static::saving(function ($article) {
            // Update status based on is_published and published_at
            if ($article->is_published) {
                if ($article->published_at) {
                    // Pastikan published_at adalah objek datetime
                    if (is_string($article->published_at)) {
                        $article->published_at = \Carbon\Carbon::parse($article->published_at);
                    }
                    
                    if ($article->published_at->isFuture()) {
                        $article->status = self::STATUS_SCHEDULED;
                    } else {
                        $article->status = self::STATUS_PUBLISHED;
                    }
                } else {
                    $article->status = self::STATUS_PUBLISHED;
                }
            } else {
                $article->status = self::STATUS_DRAFT;
            }
        });
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            // Gunakan path langsung jika file ada di public/storage
            $direct_path = public_path('storage/' . $this->thumbnail);
            if (file_exists($direct_path)) {
                return asset('storage/' . $this->thumbnail);
            }
            
            // Atau coba di storage/app/public jika ada symlink
            $storage_path = storage_path('app/public/' . $this->thumbnail);
            if (file_exists($storage_path)) {
                return asset('storage/' . $this->thumbnail);
            }
            
            // Jika masih tidak ditemukan, coba gunakan URL langsung
            return $this->thumbnail;
        }
        
        return asset('images/default-article.jpg');
    }

    /**
     * Format published date
     */
    public function getFormattedDateAttribute()
    {
        if (!$this->published_at) {
            return null;
        }
        
        return $this->published_at->setTimezone('Asia/Jakarta')->format('d M Y');
    }
    
    /**
     * Check if article is scheduled to be published
     */
    public function getIsScheduledAttribute()
    {
        return $this->status === self::STATUS_SCHEDULED;
    }
    
    /**
     * Check if article is a draft
     */
    public function getIsDraftAttribute()
    {
        return $this->status === self::STATUS_DRAFT;
    }

    /**
     * Scope a query to only include published articles
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where('status', self::STATUS_PUBLISHED);
    }
    
    /**
     * Scope a query to only include scheduled articles
     */
    public function scopeScheduled($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '>', now())
            ->where('status', self::STATUS_SCHEDULED);
    }
    
    /**
     * Scope a query to only include draft articles
     */
    public function scopeDraft($query)
    {
        return $query->where(function($q) {
            $q->where('is_published', false)
              ->orWhere('status', self::STATUS_DRAFT);
        });
    }
    
    /**
     * Scope a query to include all articles that should be shown in draft section
     * This includes both scheduled articles and drafts
     */
    public function scopeDraftSection($query)
    {
        return $query->where(function($q) {
            $q->where('status', self::STATUS_DRAFT)
              ->orWhere('status', self::STATUS_SCHEDULED);
        });
    }
}
