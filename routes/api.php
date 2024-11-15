<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Mahasiswa\HomeController;
use Illuminate\Support\Facades\Route;


Route::post('login', [LoginController::class, 'login']);

Route::get('home', [HomeController::class, 'home']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [LoginController::class, 'logout']);

    Route::get('katalog', [HomeController::class, 'katalog'])->name('katalog');
    Route::get('katalog/peminjaman-barang/{nama_barang}', [HomeController::class, 'viewbarang'])->name('viewbarang');
    Route::post('peminjaman/{barang}/{stock}', [HomeController::class, 'peminjaman']);
    Route::get('informasi', [HomeController::class, 'informasi'])->name('mahasiswa.informasi');

    Route::prefix('profile')->group(function () {
        Route::get('/', [HomeController::class, 'viewProfile'])->name('profile');
        Route::put('edit-profile/{mahasiswa}', [HomeController::class, 'editProfile'])->name('editProfile');

        Route::put('ubah-kata-sandi/{mahasiswa}', [HomeController::class, 'ubahKataSandi'])->name('ubah-kata-sandi');
    });
});
