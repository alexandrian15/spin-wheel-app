<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpinController;
use App\Http\Controllers\AdminController;

Route::get('/spin', function () {
    return view('welcome');
});

Route::get('/spin', function () {
    return view('spin');
})->middleware(['auth', 'verified'])->name('spin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [SpinController::class, 'index']);           // Tampilan utama
Route::get('/api/prizes', [SpinController::class, 'getPrizes']); // API ambil data
Route::post('/api/spin', [SpinController::class, 'spin']);     // API putar

// Admin routes - Harus login terlebih dahulu
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');     // Admin dashboard
    Route::post('/admin/hadiah', [AdminController::class, 'store'])->name('admin.store');  // Tambah hadiah
    Route::put('/admin/hadiah/{id}', [AdminController::class, 'update'])->name('admin.update');  // Update hadiah
    Route::delete('/admin/hadiah/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');  // Hapus hadiah

    Route::middleware(['auth'])->group(function () {

    Route::get('/admin/users', [
        AdminController::class,
        'users'
    ]);

    Route::post('/admin/users/{id}', [
    AdminController::class,
    'updateUserArea'
]);

});
});