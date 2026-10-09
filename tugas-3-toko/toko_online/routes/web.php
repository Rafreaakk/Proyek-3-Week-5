<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;

// Rute untuk pengunjung yang BELUM login (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Rute untuk pengguna yang SUDAH login (auth)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rute Keranjang
    Route::get('/keranjang', [ShopController::class, 'cart']);
    Route::post('/keranjang/tambah/{id}', [ShopController::class, 'addToCart']);
    Route::post('/keranjang/update/{id}', [ShopController::class, 'updateCart']);
    Route::post('/keranjang/hapus/{id}', [ShopController::class, 'removeFromCart']);

    // Rute Checkout & Riwayat
    Route::post('/checkout', [ShopController::class, 'checkout']);
    Route::get('/riwayat', [ShopController::class, 'riwayat']);
});

Route::get('/', [ShopController::class, 'index']);

