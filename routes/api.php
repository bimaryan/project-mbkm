<?php

use App\Http\Controllers\WEB\Admin\AdminController;
use App\Http\Controllers\WEB\Admin\KategoriController;
use App\Http\Controllers\WEB\Admin\ProdukController;
use App\Http\Controllers\WEB\Admin\SatuanController;
use App\Http\Controllers\WEB\Auth\LoginController;
use App\Http\Controllers\WEB\Auth\RegisterController;
use App\Http\Controllers\WEB\Dosen\DosenController;
use App\Http\Controllers\WEB\Mahasiswa\MahasiswaController;
use App\Http\Controllers\WEB\Staff\StaffController;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login-proses', [LoginController::class, 'store'])->name('login.store');
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register-proses', [RegisterController::class, 'store'])->name('register.store');

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    // Admin Routes
    Route::middleware(['role:' . Role::ADMIN])->group(function () {
        Route::get('admin', [AdminController::class, 'index'])->name('admin');

        Route::prefix('admin')->group(function () {
            // ROUTE BUAT TAMBAH USERS
            Route::get('kelola-users/users', [AdminController::class, 'users'])->name('admin.users');
            Route::get('kelola-users/users/create', [AdminController::class, 'addUsers'])->name('admin.users.create');
            Route::put('kelola-users/users/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
            Route::delete('kelola-users/users/{id}/delete', [AdminController::class, 'destroy'])->name('admin.users.delete');
            Route::post('kelola-users/users/create', [AdminController::class, 'storeUsers'])->name('admin.users.proses');

            // ROUTE BUAT TAMBAH PRODUK ALAT LAB
            Route::get('alat-dan-bahan/barang', [ProdukController::class, 'index'])->name('admin.barang');
            Route::post('alat-dan-bahan/barang/proses', [ProdukController::class, 'storeBarang'])->name('admin.barang.proses');
            Route::delete('alat-dan-bahan/barang/{barang}/delete', [ProdukController::class, 'hapus'])->name('admin.barang.hapus');
            Route::put('alat-dan-bahan/barang/{barang}/edit', [ProdukController::class, 'edit'])->name('admin.barang.edit');

            // ROUTE BUAT TAMBAH KATEGORI
            Route::get('alat-dan-bahan/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
            Route::post('alat-dan-bahan/kategori/proses', [KategoriController::class, 'store'])->name('admin.kategori.proses');
            Route::put('alat-dan-bahan/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
            Route::delete('alat-dan-bahan/kategori/{kategori}/hapus', [KategoriController::class, 'hapus'])->name('admin.kategori.hapus');

            // ROUTE BUAT TAMBAH SATUAN
            Route::get('alat-dan-bahan/satuan', [SatuanController::class, 'index'])->name('admin.satuan');
            Route::post('alat-dan-bahan/satuan/proses', [SatuanController::class, 'store'])->name('admin.satuan.proses');
            Route::delete('alat-dan-bahan/satuan/{satuan}/delete', [SatuanController::class, 'hapus'])->name('admin.satuan.hapus');
            Route::put('alat-dan-bahan/satuan/{satuan}/edit', [SatuanController::class, 'edit'])->name('admin.satuan.edit');
        });
    });

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
