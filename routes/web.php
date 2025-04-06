<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ConvertController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication routes
Route::middleware('guest')->group(function () {
    // Manual authentication
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Google authentication
    Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Home/Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('home');
    
    // Profile routes
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
    
    // User routes
    Route::middleware('role:user,premium,admin')->group(function () {
        Route::get('/convert', function () {
            return view('convert.index');
        })->name('convert.index');
        
        // Image conversion
        Route::get('/convert/image', [ConvertController::class, 'showImageForm'])->name('convert.image.form');
        Route::post('/convert/image', [ConvertController::class, 'convertImage'])->name('convert.image');
        
        // PDF conversion (restricted to premium and admin users)
        Route::middleware('role:premium,admin')->group(function () {
            Route::get('/convert/pdf', [ConvertController::class, 'showPdfForm'])->name('convert.pdf.form');
            Route::post('/convert/pdf-to-word', [ConvertController::class, 'pdfToWord'])->name('convert.pdf-to-word');
            Route::post('/convert/word-to-pdf', [ConvertController::class, 'wordToPdf'])->name('convert.word-to-pdf');
        });
    });
    
    // Premium user routes
    Route::middleware('role:premium,admin')->group(function () {
        Route::get('/premium', function () {
            return view('premium.index');
        })->name('premium.index');
    });
    
    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', function () {
            return view('admin.index');
        })->name('admin.index');
    });
});
