<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;

// Rute untuk pengguna yang belum login (guest)
Route::middleware('guest')->group(function () {
    Route::get ('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// redirect Rute utama '/' ke 'login' 
Route::get('/', function () {
    return view('/login');
});

// Rute untuk pengguna yang sudah login (auth)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::patch('/admin/users/{user}/role',
    [RoleController::class, 'update'])
    ->middleware(['auth', 'can:manage-roles'])
    ->name('admin.users.role.update');

    // Rute simulasi untuk testing Gate use-cart
Route::post('/cart/add', function () {
    return 'Sukses menambah barang ke keranjang!';
})->middleware(['auth', 'can:use-cart']);