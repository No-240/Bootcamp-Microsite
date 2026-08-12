<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function (){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Route Logout (Wajib Memiliki Sesi Terautentikasi)
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ============================================
// ROUTE PUBLIK (Halaman Utama)
// ============================================
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/download/vcf', [PublicController::class, 'downloadVcf'])->name('public.download.vcf');

// Route Perantara Pelacak Klik (Intermediary Tracking)
Route::get('/go/{link}', [PublicController::class, 'redirect'])->name('public.redirect');


// ============================================
// ROUTE ADMIN (Dashboard & Manajemen)
// Terproteksi Middleware 'auth'
// ============================================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // ---- DASHBOARD ANALYTICS ----
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ---- MANAJEMEN PROFILE ----
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // ---- MANAJEMEN LINKS (CRUD) ----
    // Index, Create, Store
    Route::get('/links', [LinkController::class, 'index'])->name('links.index');
    Route::get('/links/create', [LinkController::class, 'create'])->name('links.create');
    Route::post('/links', [LinkController::class, 'store'])->name('links.store');

    // Edit, Update, Destroy
    Route::get('/links/{link}/edit', [LinkController::class, 'edit'])->name('links.edit');
    Route::put('/links/{link}', [LinkController::class, 'update'])->name('links.update');
    Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');
});

// ============================================
// ROUTE FALLBACK (404)
// ============================================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
