<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google authentication
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    /**
     * Handle Google callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Jika tidak mendapatkan email dari Google
            if (!$googleUser->getEmail()) {
                return redirect()->route('login')
                    ->with('error', 'Gagal mendapatkan email dari akun Google Anda. Silakan coba lagi.');
            }
            
            $user = User::where('google_id', $googleUser->getId())->first();
            
            if (!$user) {
                // Periksa apakah pengguna dengan email ini sudah ada
                $existingUser = User::where('email', $googleUser->getEmail())->first();
                
                if ($existingUser) {
                    // Update pengguna yang ada dengan Google ID
                    $existingUser->update([
                        'google_id' => $googleUser->getId(),
                        'name' => $googleUser->getName(), // Update nama jika diperlukan
                    ]);
                    $user = $existingUser;
                    
                    Log::info('Pengguna yang ada terhubung dengan Google', [
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId()
                    ]);
                } else {
                    // Buat pengguna baru
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'password' => Hash::make(bin2hex(random_bytes(16))), // Generate password aman
                        'google_id' => $googleUser->getId(),
                        'role' => User::ROLE_USER,
                    ]);
                    
                    Log::info('Pengguna baru dibuat melalui Google', [
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId()
                    ]);
                }
            }
            
            // Login pengguna
            Auth::login($user, true);
            
            Log::info('Login berhasil melalui Google', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);
            
            return redirect()->route('home')->with('success', 'Selamat datang, ' . $user->name . '!');
            
        } catch (\Exception $e) {
            Log::error('Google login error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }
}
