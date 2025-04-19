<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Auth\EmailVerificationNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Role constants
     */
    const ROLE_USER = 0;
    const ROLE_PREMIUM = 1;
    const ROLE_ADMIN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'daily_conversions',
        'last_conversion_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'integer',
            'daily_conversions' => 'integer',
            'last_conversion_date' => 'date',
        ];
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    /**
     * Check if user is premium user
     */
    public function isPremium(): bool
    {
        return $this->role === self::ROLE_PREMIUM;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Get remaining daily conversions
     */
    public function getRemainingConversions(): string
    {
        if ($this->isPremium() || $this->isAdmin()) {
            return 'Tak Terbatas';
        }

        $today = now()->format('Y-m-d');
        if ($this->last_conversion_date === null || $this->last_conversion_date->format('Y-m-d') !== $today) {
            $this->daily_conversions = 0;
            $this->last_conversion_date = now();
            $this->save();
        }

        return (20 - $this->daily_conversions) . '/20';
    }

    /**
     * Record a conversion usage
     */
    public function recordConversion(): bool
    {
        // Premium and admin users have unlimited conversions
        if ($this->isPremium() || $this->isAdmin()) {
            return true;
        }

        // Reset counter if it's a new day
        $today = now()->format('Y-m-d');
        if ($this->last_conversion_date === null || $this->last_conversion_date->format('Y-m-d') !== $today) {
            $this->daily_conversions = 0;
            $this->last_conversion_date = now();
        }

        // Check if user has reached their daily limit (20 conversions)
        if ($this->daily_conversions >= 20) {
            return false;
        }

        // Increment usage and update date
        $this->daily_conversions += 1;
        $this->last_conversion_date = now();
        $this->save();

        return true;
    }

    /**
     * Check if user can perform a conversion
     */
    public function canConvert(): bool
    {
        // Premium and admin users have unlimited conversions
        if ($this->isPremium() || $this->isAdmin()) {
            return true;
        }

        // Reset counter if it's a new day
        $today = now()->format('Y-m-d');
        if ($this->last_conversion_date === null || $this->last_conversion_date->format('Y-m-d') !== $today) {
            $this->daily_conversions = 0;
            $this->last_conversion_date = now();
            $this->save();
            return true;
        }

        // Check if user has reached their daily limit (20 conversions)
        return $this->daily_conversions < 20;
    }

    /**
     * Determine if the user can access the Filament admin panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin() && $panel->getId() === 'admin';
    }
    
    /**
     * Get the conversion statistics for the user.
     */
    public function conversionStatistics(): HasMany
    {
        return $this->hasMany(ConversionStatistic::class);
    }
    
    /**
     * Get the converted images for the user.
     */
    public function convertedImages(): HasMany
    {
        return $this->hasMany(ConvertedImage::class);
    }

    /**
     * Send the email verification notification.
     * 
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        try {
            $this->notify(new EmailVerificationNotification);
            Log::info('Email verifikasi berhasil dikirim', ['user_id' => $this->id, 'email' => $this->email]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email verifikasi', [
                'user_id' => $this->id, 
                'email' => $this->email,
                'error' => $e->getMessage()
            ]);
            
            // Fallback: Coba kirim email via cara alternatif jika konfigurasi utama gagal
            try {
                Mail::to($this->email)->send(new \App\Mail\EmailVerification($this));
                Log::info('Email verifikasi berhasil dikirim via fallback', ['user_id' => $this->id]);
            } catch (\Exception $e2) {
                Log::error('Fallback pengiriman email juga gagal', [
                    'user_id' => $this->id,
                    'error' => $e2->getMessage()
                ]);
            }
        }
    }
}
