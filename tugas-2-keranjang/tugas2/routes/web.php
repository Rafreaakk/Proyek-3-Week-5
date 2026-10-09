<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::get('/', [CartController::class, 'index']);
Route::get('/keranjang', [CartController::class, 'cart']);

// Rute aksi keranjang
Route::post('/keranjang/tambah/{id}', [CartController::class, 'add']);
Route::post('/keranjang/update/{id}', [CartController::class, 'update']);
Route::post('/keranjang/hapus/{id}', [CartController::class, 'remove']);
Route::post('/keranjang/kosongkan', [CartController::class, 'clear']);