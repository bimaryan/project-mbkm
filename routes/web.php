<?php

use App\Http\Controllers\WEB\Admin\AdminController;
use App\Http\Controllers\WEB\Admin\KategoriController;
use App\Http\Controllers\WEB\Admin\ProdukController;
use App\Http\Controllers\WEB\Auth\LoginController;
use App\Http\Controllers\WEB\Auth\RegisterController;
use App\Http\Controllers\WEB\Dosen\DosenController;
use App\Http\Controllers\WEB\Mahasiswa\MahasiswaController;
use App\Http\Controllers\WEB\Staff\StaffController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login-proses', [LoginController::class, 'store'])->name('login.store');
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register-proses', [RegisterController::class, 'store'])->name('register.store');

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    // Admin Routes
    Route::middleware(['role:' . Role::ADMIN])->group(function () {
        Route::get('admin', [AdminController::class, 'index'])->name('admin');

        // User Management Routes
        Route::prefix('admin/kelola-users')->group(function () {
            Route::get('users', [AdminController::class, 'users'])->name('admin.users');
            Route::get('users/create', [AdminController::class, 'addUsers'])->name('admin.users.create');
            Route::put('users/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
            Route::delete('users/{id}/delete', [AdminController::class, 'destroy'])->name('admin.users.delete');
            Route::post('users/create', [AdminController::class, 'storeUsers'])->name('admin.users.proses');
        });

        // Product Management Routes
        Route::prefix('admin/alat-dan-bahan')->group(function () {
            Route::get('barang', [ProdukController::class, 'index'])->name('admin.barang');
            Route::post('barang/proses', [ProdukController::class, 'storeBarang'])->name('admin.barang.proses');
            Route::delete('barang/{barang}/delete', [ProdukController::class, 'hapus'])->name('admin.barang.hapus');

            // Category Management Routes
            Route::get('kategori', [KategoriController::class, 'index'])->name('admin.kategori');
            Route::post('kategori/proses', [KategoriController::class, 'store'])->name('admin.kategori.proses');
            Route::put('kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
            Route::delete('kategori/{kategori}/hapus', [KategoriController::class, 'hapus'])->name('admin.kategori.hapus');
        });
    });

    // Dosen Routes
    Route::middleware(['role:' . Role::DOSEN])->group(function () {
        Route::get('dosen', [DosenController::class, 'index'])->name('dosen');
    });

    // Mahasiswa Routes
    Route::middleware(['role:' . Role::MAHASISWA])->group(function () {
        Route::get('/', [MahasiswaController::class, 'home'])->name('mahasiswa');
        Route::get('katalog', [MahasiswaController::class, 'katalog'])->name('mahasiswa.katalog');
        Route::get('katalog/peminjaman-barang/{name}', [MahasiswaController::class, 'viewbarang'])->name('mahasiswa.viewbarang');
    });
});
