<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConvertedImage extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'original_filename',
        'original_path',
        'converted_filename',
        'converted_path',
        'conversion_type',
        'original_size',
        'converted_size',
        'compression_ratio',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'compression_ratio' => 'float',
    ];
    
    /**
     * Get the user that owns the image.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the formatted original size.
     */
    public function getFormattedOriginalSizeAttribute()
    {
        return $this->formatSize($this->original_size);
    }
    
    /**
     * Get the formatted converted size.
     */
    public function getFormattedConvertedSizeAttribute()
    {
        return $this->formatSize($this->converted_size);
    }
    
    /**
     * Format size in bytes to human readable format.
     */
    protected function formatSize($size)
    {
        if (!$size) return '0 B';
        
        $size = (int) $size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = floor(log($size, 1024));
        
        return round($size / pow(1024, $i), 2) . ' ' . $units[$i];
    }
    
    /**
     * Get the compression percentage.
     */
    public function getCompressionPercentageAttribute()
    {
        if (!$this->original_size || !$this->converted_size) {
            return 0;
        }
        
        $originalSize = (int) $this->original_size;
        $convertedSize = (int) $this->converted_size;
        
        return round(100 - ($convertedSize / $originalSize * 100), 2);
    }
}
