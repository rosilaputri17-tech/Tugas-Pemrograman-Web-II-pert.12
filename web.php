<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;

/*
|--------------------------------------------------------------------------
| Redirect Root
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Buku
|--------------------------------------------------------------------------
*/

// Search buku
Route::get('/buku/search', [BukuController::class, 'search'])
    ->name('buku.search');

// Filter buku berdasarkan kategori
Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])
    ->name('buku.kategori');

// Bulk delete buku
Route::post('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])
    ->name('buku.bulk-delete');

// Resource buku
Route::resource('buku', BukuController::class);

/*
|--------------------------------------------------------------------------
| Anggota
|--------------------------------------------------------------------------
*/

Route::resource('anggota', AnggotaController::class);