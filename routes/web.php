<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\Auth\LoginController;
use App\Http\Controllers\WEB\Admin\AdminController;
use App\Http\Controllers\WEB\Admin\DosenController;
use App\Http\Controllers\WEB\Admin\ProdukController;
use App\Http\Controllers\WEB\Admin\SatuanController;
use App\Http\Controllers\WEB\Admin\KategoriController;
use App\Http\Controllers\WEB\Admin\PeminjamanController;
use App\Http\Controllers\WEB\Auth\ForgotPasswordController;
use App\Http\Controllers\WEB\Admin\MahasiswaController;
use App\Http\Controllers\WEB\Admin\MataKuliahController;
use App\Http\Controllers\WEB\Mahasiswa\HomeController;

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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login-process', [LoginController::class, 'login'])->name('login-process');

Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
Route::post('forgot-password-process', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password-process');

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password-process/{token}', [ForgotPasswordController::class, 'resetPasswordProcess'])->name('reset-password-process');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::middleware(['UserAccess:Admin'])->group(function () {
        Route::prefix('pengguna')->group(function () {
            // ROUTE DATA ADMIN DAN STAFF
            Route::get('/data-admin-dan-staff', [AdminController::class, 'adminAndStaff'])->name('data-admin-dan-staff');
            Route::post('/data-admin-dan-staff/proses', [AdminController::class, 'storeAdminAndStaff'])->name('data-admin-dan-staff.proses');
            Route::delete('/data-admin-dan-staff/{user}/hapus', [AdminController::class, 'deleteAdminDanStaff'])->name('data-admin-dan-staff.delete');
            Route::put('/data-admin-dan-staff/{user}/edit', [AdminController::class, 'editAdminDanStaff'])->name('data-admin-dan-staff.edit');

            // ROUTE DATA MAHASISWA
            Route::get('/data-mahasiswa', [MahasiswaController::class, 'mahasiswa'])->name('data-mahasiswa');
            Route::post('/data-mahasiswa/proses', [MahasiswaController::class, 'storeMahasiswa'])->name('data-mahasiswa.proses');
            Route::put('/data-mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'editMahasiswa'])->name('data-mahasiswa.edit');
            Route::delete('/data-mahasiswa/{mahasiswa}/hapus', [MahasiswaController::class, 'deleteMahasiswa'])->name('data-mahasiswa.delete');

            // ROUTE DATA DOSEN
            Route::get('/data-dosen', [DosenController::class, 'dosen'])->name('data-dosen');
            Route::post('/data-dosen/proses', [DosenController::class, 'storeDosen'])->name('data-dosen.proses');
            Route::put('/data-dosen/{dosen}/edit', [DosenController::class, 'editDosen'])->name('data-dosen.edit');
            Route::delete('/data-dosen/{dosen}/hapus', [DosenController::class, 'deleteDosen'])->name('data-dosen.delete');
        });

        // ROUTE DATA KELAS
        Route::get('/data-kelas', [MahasiswaController::class, 'kelas'])->name('data-kelas');
        Route::post('/data-kelas/proses', [MahasiswaController::class, 'storeKelas'])->name('data-kelas.proses');
        Route::put('/data-kelas/{kelas}/edit', [MahasiswaController::class, 'editKelas'])->name('data-kelas.edit');
        Route::delete('/data-kelas/{kelas}/hapus', [MahasiswaController::class, 'deleteKelas'])->name('data-kelas.delete');

        // ROUTE DATA MATAKULIAH
        Route::get('/data-mata-kuliah', [MataKuliahController::class, 'matakuliah'])->name('data-mata-kuliah');
        Route::post('/data-mata-kuliah/proses', [MataKuliahController::class, 'storeMatakuliah'])->name('data-mata-kuliah.proses');
        Route::put('/data-mata-kuliah/{mataKuliah}/edit', [MataKuliahController::class, 'editMatakuliah'])->name('data-mata-kuliah.edit');
        Route::delete('/data-mata-kuliah/{matakuliah}/hapus', [MataKuliahController::class, 'deleteMatakuliah'])->name('data-mata-kuliah.delete');
    });

    Route::middleware(['UserAccess:Staff'])->group(function () {
        Route::prefix('staff/')->group(function () {
            // ROUTE DATA BARANG
            Route::get('data-barang', [ProdukController::class, 'barang'])->name('data-barang');
            Route::post('data-barang/proses', [ProdukController::class, 'storeBarang'])->name('data-barang.proses');
            Route::put('data-barang/{barang}/edit', [ProdukController::class, 'editBarang'])->name('data-barang.edit');
            Route::delete('data-barang/{barang}/hapus', [ProdukController::class, 'deleteBarang'])->name('data-barang.hapus');

            // ROUTE DATA KATEGORI
            Route::get('data-kategori', [KategoriController::class, 'kategori'])->name('data-kategori');
            Route::post('data-kategori/proses', [KategoriController::class, 'storeKategori'])->name('data-kategori.proses');
            Route::put('data-kategori/{kategori}/edit', [KategoriController::class, 'editKategori'])->name('data-kategori.edit');
            Route::delete('data-kategori/{kategori}/hapus', [KategoriController::class, 'deleteKategori'])->name('data-kategori.hapus');

            // ROUTE DATA SATUAN
            Route::get('data-satuan', [SatuanController::class, 'satuan'])->name('data-satuan');
            Route::post('data-satuan/proses', [SatuanController::class, 'storeSatuan'])->name('data-satuan.proses');
            Route::delete('data-satuan/{satuan}/hapus', [SatuanController::class, 'deleteSatuan'])->name('data-satuan.hapus');
            Route::put('data-satuan/{satuan}/edit', [SatuanController::class, 'editSatuan'])->name('data-satuan.edit');
        });

        // ROUTE VERIFIKASI PEMINJAMAN
        Route::get('verifikasi-peminjaman', [PeminjamanController::class, 'index'])->name('verifikasi');
        Route::put('verifikasi-peminjaman/{peminjaman}', [PeminjamanController::class, 'update'])->name('verifikasi.update');
    });
});

Route::middleware(['auth:mahasiswa'])->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('home', [HomeController::class, 'home'])->name('mahasiswa');
    Route::get('katalog', [HomeController::class, 'katalog'])->name('katalog');
    Route::get('katalog/peminjaman-barang/{nama_barang}', [HomeController::class, 'viewbarang'])->name('viewbarang');
    Route::post('peminjaman/{barang}/{stock}', [HomeController::class, 'peminjaman'])->name('mahasiswa.peminjaman');
    Route::get('informasi', [HomeController::class, 'informasi'])->name('mahasiswa.informasi');

    Route::get('profile', [HomeController::class, 'viewProfile'])->name('profile');
    Route::put('edit-profile/{mahasiswa}', [HomeController::class, 'editProfile'])->name('editProfile');

    Route::get('ubah-kata-sandi', [HomeController::class, 'ViewUbahKataSandi'])->name('view-ubah-kata-sandi');
    Route::put('ubah-kata-sandi/{mahasiswa}', [HomeController::class, 'ubahKataSandi'])->name('ubah-kata-sandi');
});
