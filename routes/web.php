<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ConvertController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
    
    // Tambahkan route alternatif untuk Google callback
    Route::get('/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
});

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('resent', true);
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Home/Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('home');
    
    // Profile routes
    Route::get('/profile', function () {
        return view('profile.edit');
    })->middleware('verified')->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->middleware('verified')->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->middleware('verified')->name('profile.password.update');
    
    // User routes
    Route::middleware(['verified', CheckRole::class . ':user,premium,admin'])->group(function () {
        Route::get('/convert', [ConvertController::class, 'index'])->name('convert.index');
        
        // Image conversion
        Route::get('/convert/image', [ConvertController::class, 'showImageForm'])->name('convert.image.form');
        Route::post('/convert/image', [ConvertController::class, 'convertImage'])->name('convert.image');
        Route::get('/convert/image/download-all', [ConvertController::class, 'downloadAllImages'])->name('convert.image.download-all');
        
        // PDF conversion (restricted to premium and admin users)
        Route::middleware(CheckRole::class . ':premium,admin')->group(function () {
            Route::get('/convert/pdf-to-word', [ConvertController::class, 'showPdfToWordForm'])->name('convert.pdf-to-word.form');
            Route::get('/convert/word-to-pdf', [ConvertController::class, 'showWordToPdfForm'])->name('convert.word-to-pdf.form');
            Route::post('/convert/pdf-to-word', [ConvertController::class, 'pdfToWord'])->name('convert.pdf-to-word');
            Route::post('/convert/word-to-pdf', [ConvertController::class, 'wordToPdf'])->name('convert.word-to-pdf');
        });
    });
    
    // Premium user routes
    Route::middleware(['verified', CheckRole::class . ':premium,admin'])->group(function () {
        Route::get('/premium', function () {
            return view('premium.index');
        })->name('premium.index');
    });
    
    // Admin routes - Comment this section as Filament will handle the routes
    /*
    Route::middleware(['auth', 'verified', CheckRole::class . ':admin'])->group(function () {
        // Redirect ke Filament admin panel
        Route::get('/admin', function() {
            return redirect('/admin/users');
        })->name('admin.index');
    });
    */
});

// PDF and Word conversion routes (with cloud options) - Premium/Admin only
Route::middleware(['auth', 'verified', CheckRole::class . ':premium,admin'])->group(function () {
    Route::get('/convert/pdf-to-word', [ConvertController::class, 'showPdfToWordForm'])->name('convert.pdf-to-word.form');
    Route::post('/convert/pdf-to-word', [ConvertController::class, 'pdfToWord'])->name('convert.pdf-to-word');
    Route::post('/convert/pdf-to-word/cloud', [ConvertController::class, 'pdfToWordCloudConvert'])->name('convert.pdf-to-word.cloud');

    Route::get('/convert/word-to-pdf', [ConvertController::class, 'showWordToPdfForm'])->name('convert.word-to-pdf.form');
    Route::post('/convert/word-to-pdf', [ConvertController::class, 'wordToPdf'])->name('convert.word-to-pdf');
    Route::post('/convert/word-to-pdf/cloud', [ConvertController::class, 'wordToPdfCloudConvert'])->name('convert.word-to-pdf.cloud');
});

// Test route for 404 error page
Route::get('/test-404', function () {
    abort(404);
});

// Test route for 500 error page
Route::get('/test-500', function () {
    abort(500);
});

// Test route for 403 error page
Route::get('/test-403', function () {
    abort(403);
});

// Test route for 419 error page
Route::get('/test-419', function () {
    abort(419);
});

// artikel routes
Route::get('/artikel', [App\Http\Controllers\ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [App\Http\Controllers\ArtikelController::class, 'show'])->name('artikel.show');

// Static page routes
Route::get('/tentang-kami', [App\Http\Controllers\StaticPageController::class, 'show'])->name('tentang-kami')->defaults('slug', 'tentang-kami');
Route::get('/kebijakan-privasi', [App\Http\Controllers\StaticPageController::class, 'show'])->name('kebijakan-privasi')->defaults('slug', 'kebijakan-privasi');
Route::get('/syarat-ketentuan', [App\Http\Controllers\StaticPageController::class, 'show'])->name('syarat-ketentuan')->defaults('slug', 'syarat-ketentuan');
