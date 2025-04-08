<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConversionStatistic extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'conversion_type',
        'user_id',
        'original_filename',
        'converted_filename',
        'original_size',
        'converted_size',
        'ip_address',
        'user_agent',
    ];
    
    /**
     * Get the user that owns the conversion.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Scope a query to only include image conversions.
     */
    public function scopeImages($query)
    {
        return $query->where('conversion_type', 'image');
    }
    
    /**
     * Scope a query to only include PDF to Word conversions.
     */
    public function scopePdfToWord($query)
    {
        return $query->where('conversion_type', 'pdf_to_word');
    }
    
    /**
     * Scope a query to only include Word to PDF conversions.
     */
    public function scopeWordToPdf($query)
    {
        return $query->where('conversion_type', 'word_to_pdf');
    }
}
