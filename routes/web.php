<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\COAController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// dashboardbootstrap
Route::get('/dashboardbootstrap', function () {
    return view('dashboardbootstrap');
})->middleware(['auth'])->name('dashboardbootstrap');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// route ke master data perusahaan
Route::resource('/perusahaan', PerusahaanController::class)->middleware(['auth']);
Route::get('/perusahaan/destroy/{id}', [App\Http\Controllers\PerusahaanController::class,'destroy'])->middleware(['auth']);

// route ke master data produk  
Route::resource('/produk', ProdukController::class)->middleware(['auth']);
Route::get('/produk/destroy/{id}', [App\Http\Controllers\ProdukController::class,'destroy'])->middleware(['auth']);

// route ke master data pegawai
Route::resource('/pegawai', PegawaiController::class)->middleware(['auth']);
Route::get('/pegawai/destroy/{id}', [App\Http\Controllers\PegawaiController::class,'destroy'])->middleware(['auth']);

// route ke master data coa
Route::resource('/coa', COAController::class)->middleware(['auth']);
Route::get('/coa/destroy/{id}', [App\Http\Controllers\COAController::class,'destroy'])->middleware(['auth']);

require __DIR__.'/auth.php';
