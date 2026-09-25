<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $latestPosts = \App\Models\Post::where('is_published', true)->latest()->take(3)->get();
    $programStudis = \App\Models\ProgramStudi::active()->orderBy('kode_nim')->get();
    return view('welcome', compact('latestPosts', 'programStudis'));
});

// ============================================
// Rute Publik (Front-End Website)
// ============================================
Route::get('/berita', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::get('/dokumen', [\App\Http\Controllers\DocumentController::class, 'index'])->name('documents.index');
Route::get('/dokumen/{document}/download', [\App\Http\Controllers\DocumentController::class, 'download'])->name('documents.download');

Route::get('/halaman/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('pages.show');

Route::get('/program-studi', function () {
    $programStudis = \App\Models\ProgramStudi::active()->orderBy('kode_nim')->get();
    return view('prodi.index', compact('programStudis'));
})->name('prodi.index');

// PMB Online Public Routes
Route::get('/pmb', [\App\Http\Controllers\PmbController::class, 'jalur'])->name('pmb.jalur');
Route::get('/pmb/cek-status', [\App\Http\Controllers\PmbController::class, 'checkStatus'])->name('pmb.status_check');
Route::get('/pmb/daftar', [\App\Http\Controllers\PmbController::class, 'create'])->name('pmb.create');
Route::post('/pmb/daftar', [\App\Http\Controllers\PmbController::class, 'store'])->name('pmb.store');
Route::get('/pmb/sukses/{id}', [\App\Http\Controllers\PmbController::class, 'success'])->name('pmb.success');
Route::get('/pmb/cetak/{id}', [\App\Http\Controllers\PmbController::class, 'print'])->name('pmb.print');
Route::post('/pmb/{id}/upload-bukti-bayar', [\App\Http\Controllers\PmbController::class, 'uploadBuktiBayar'])->name('pmb.upload_bukti_bayar');

// Back-end routes (CMS) protected by auth and role
Route::middleware(['auth', 'verified', 'role:Super Admin|Admin CMS|Staff Panitia PMB|Staff Keuangan'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // CMS Routes (dibatasi Super Admin dan Admin CMS)
    Route::middleware(['role:Super Admin|Admin CMS'])->group(function() {
        Route::post('posts/upload-image', [\App\Http\Controllers\Admin\PostController::class, 'uploadImage'])->name('posts.upload_image');
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
        Route::resource('documents', \App\Http\Controllers\Admin\DocumentController::class);
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::patch('program-studi/{programStudi}/toggle-active', [\App\Http\Controllers\Admin\ProgramStudiController::class, 'toggleActive'])->name('program-studi.toggle_active');
        Route::resource('program-studi', \App\Http\Controllers\Admin\ProgramStudiController::class);
    });
    
    // PMB Admin Routes
    Route::get('pmb', [\App\Http\Controllers\Admin\PmbController::class, 'index'])->name('pmb.index');
    Route::get('pmb/print-rekap', [\App\Http\Controllers\Admin\PmbController::class, 'printRekap'])->name('pmb.print_rekap');
    Route::get('pmb-gelombang', [\App\Http\Controllers\Admin\PmbWaveController::class, 'index'])->name('pmb_waves.index');
    Route::post('pmb-gelombang', [\App\Http\Controllers\Admin\PmbWaveController::class, 'update'])->name('pmb_waves.update');
    Route::post('pmb-gelombang/store', [\App\Http\Controllers\Admin\PmbWaveController::class, 'store'])->name('pmb_waves.store');
    Route::delete('pmb-gelombang/{id}', [\App\Http\Controllers\Admin\PmbWaveController::class, 'destroy'])->name('pmb_waves.destroy');
    Route::get('pmb-biaya', [\App\Http\Controllers\Admin\PmbFeeController::class, 'index'])->name('pmb_fees.index');
    Route::post('pmb-biaya', [\App\Http\Controllers\Admin\PmbFeeController::class, 'update'])->name('pmb_fees.update');
    Route::get('pmb/{id}', [\App\Http\Controllers\Admin\PmbController::class, 'show'])->name('pmb.show');
    Route::put('pmb/{id}/status', [\App\Http\Controllers\Admin\PmbController::class, 'updateStatus'])->name('pmb.status');
    Route::post('pmb/{id}/verify-payment', [\App\Http\Controllers\Admin\PmbController::class, 'verifyPayment'])->name('pmb.verify_payment');
    Route::post('pmb/{id}/sync-sia', [\App\Http\Controllers\Admin\PmbController::class, 'syncSia'])->name('pmb.sync_sia');
    Route::delete('pmb/{id}', [\App\Http\Controllers\Admin\PmbController::class, 'destroy'])->name('pmb.destroy');
});

// Redirect /dashboard ke admin dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Storage File Serving Fallback (Memastikan Gambar & Dokumen Pasti Terbuka di Hosting Nginx/Apache)
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    return response()->file($filePath);
})->where('path', '.*');

