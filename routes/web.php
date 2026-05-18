<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpinController;
use App\Http\Controllers\AdminController;

Route::get('/', [SpinController::class, 'index']);           // Tampilan utama
Route::get('/api/prizes', [SpinController::class, 'getPrizes']); // API ambil data
Route::post('/api/spin', [SpinController::class, 'spin']);     // API putar
Route::get('/admin', [AdminController::class, 'index']);     // Admin dashboard
Route::post('/admin/hadiah', [AdminController::class, 'store']);  // Tambah hadiah
Route::put('/admin/hadiah/{id}', [AdminController::class, 'update']);  // Update hadiah
Route::delete('/admin/hadiah/{id}', [AdminController::class, 'destroy']);  // Hapus hadiah