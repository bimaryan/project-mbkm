<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Mahasiswa\HomeController;
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

Route::post('auth/login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [LoginController::class, 'logout']);

    Route::get('home', [HomeController::class, 'home']);
    Route::get('katalog', [HomeController::class, 'katalog'])->name('katalog');
    Route::get('katalog/peminjaman-barang/{nama_barang}', [HomeController::class, 'viewbarang'])->name('viewbarang');
    Route::post('peminjaman/{barang}/{stock}', [HomeController::class, 'peminjaman']);
    Route::get('informasi', [HomeController::class, 'informasi'])->name('mahasiswa.informasi');
    Route::put('informasi/{peminjaman}', [HomeController::class, 'kembali'])->name('mahasiswa.kembali');

    Route::prefix('profile')->group(function () {
        Route::get('/', [HomeController::class, 'viewProfile'])->name('profile');
        Route::put('edit-profile/{mahasiswa}', [HomeController::class, 'editProfile'])->name('editProfile');

        Route::get('ubah-kata-sandi', [HomeController::class, 'ViewUbahKataSandi'])->name('view-ubah-kata-sandi');
        Route::put('ubah-kata-sandi/{mahasiswa}', [HomeController::class, 'ubahKataSandi'])->name('ubah-kata-sandi');
    });
});
