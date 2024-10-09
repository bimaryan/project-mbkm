<?php

use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\Admin\KelasController;
use App\Http\Controllers\WEB\Auth\LoginController;
use App\Http\Controllers\WEB\Admin\AdminController;
use App\Http\Controllers\WEB\Dosen\DosenController;
use App\Http\Controllers\WEB\Admin\ProdukController;
use App\Http\Controllers\WEB\Admin\SatuanController;
use App\Http\Controllers\WEB\Auth\RegisterController;
use App\Http\Controllers\WEB\Admin\KategoriController;
use App\Http\Controllers\WEB\Admin\PeminjamanController;
use App\Http\Controllers\WEB\Auth\ForgotPasswordController;
use App\Http\Controllers\WEB\Admin\MahasiswaController;
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
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::middleware(['UserAccess:Admin'])->group(function () {
        Route::prefix('pengguna')->group(function () {
            Route::get('/data-admin-dan-staff', [AdminController::class, 'adminAndStaff'])->name('data-admin-dan-staff');
            Route::post('/data-admin-dan-staff/proses', [AdminController::class, 'storeAdminAndStaff'])->name('data-admin-dan-staff.proses');
            Route::delete('/data-admin-dan-staff/{user}/delete', [AdminController::class, 'deleteAdminDanStaff'])->name('data-admin-dan-staff.delete');
            Route::put('/data-admin-dan-staff/{user}/edit', [AdminController::class, 'editAdminDanStaff'])->name('data-admin-dan-staff.edit');

            // ROUTE DATA MAHASISWA
            Route::get('/data-mahasiswa', [MahasiswaController::class, 'mahasiswa'])->name('data-mahasiswa');
            Route::post('/data-mahasiswa/proses', [MahasiswaController::class, 'storeMahasiswa'])->name('data-mahasiswa.proses');
            Route::put('/data-mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'editMahasiswa'])->name('data-mahasiswa.edit');
            Route::delete('/data-mahasiswa/{mahasiswa}/delete', [MahasiswaController::class, 'deleteMahasiswa'])->name('data-mahasiswa.delete');

            // ROUTE DATA KELAS
            Route::get('/data-kelas', [MahasiswaController::class, 'kelas'])->name('data-kelas');
            Route::post('/data-kelas/proses', [MahasiswaController::class, 'storeKelas'])->name('data-kelas.proses');
            Route::delete('/data-kelas/{kelas}/delete', [MahasiswaController::class, 'deleteKelas'])->name('data-kelas.delete');
        });
    });

    Route::middleware(['UserAccess:Staff'])->group(function () {
        Route::get('data-admin-dan-staff', [AdminController::class, 'adminAndStaff'])->name('data-admin-dan-staff');
        Route::post('data-admin-dan-staff/proses', [AdminController::class, 'storeAdminAndStaff'])->name('data-admin-dan-staff.proses');
        Route::delete('data-admin-dan-staff/{user}/delete', [AdminController::class, 'deleteAdminDanStaff'])->name('data-admin-dan-staff.delete');
        Route::put('data-admin-dan-staff/{user}/edit', [AdminController::class, 'editAdminDanStaff'])->name('data-admin-dan-staff.edit');

        // ROUTE DATA MAHASISWA
        Route::get('data-mahasiswa', [MahasiswaController::class, 'mahasiswa'])->name('data-mahasiswa');
        Route::post('data-mahasiswa/proses', [MahasiswaController::class, 'storeMahasiswa'])->name('data-mahasiswa.proses');
        Route::put('data-mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'editMahasiswa'])->name('data-mahasiswa.edit');
        Route::delete('data-mahasiswa/{mahasiswa}/delete', [MahasiswaController::class, 'deleteMahasiswa'])->name('data-mahasiswa.delete');

        // ROUTE DATA KELAS
        Route::get('data-kelas', [MahasiswaController::class, 'kelas'])->name('data-kelas');
        Route::post('data-kelas/proses', [MahasiswaController::class, 'storeKelas'])->name('data-kelas.proses');
        Route::delete('data-kelas/{kelas}/delete', [MahasiswaController::class, 'deleteKelas'])->name('data-kelas.delete');

        // ROUTE DATA BARANG
        Route::get('data-barang', [ProdukController::class, 'barang'])->name('data-barang');
        Route::post('data-barang/proses', [ProdukController::class, 'storeBarang'])->name('data-barang.proses');
        Route::put('data-barang/{barang}/edit', [ProdukController::class, 'editBarang'])->name('data-barang.edit');
        Route::delete('data-barang/{barang}/hapus', [ProdukController::class, 'deleteBarang'])->name('data-barang.hapus');

        // ROUTE BUAT TAMBAH KATEGORI
        Route::get('data-kategori', [KategoriController::class, 'index'])->name('data-kategori');
        Route::post('data-kategori/proses', [KategoriController::class, 'store'])->name('data-kategori.proses');
        Route::put('data-kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('data-kategori.edit');
        Route::delete('data-kategori/{kategori}/hapus', [KategoriController::class, 'hapus'])->name('data-kategori.hapus');

        // ROUTE BUAT TAMBAH SATUAN
        Route::get('data-satuan', [SatuanController::class, 'index'])->name('data-satuan');
        Route::post('data-satuan/proses', [SatuanController::class, 'store'])->name('data-satuan.proses');
        Route::delete('data-satuan/{satuan}/delete', [SatuanController::class, 'hapus'])->name('data-satuan.hapus');
        Route::put('data-satuan/{satuan}/edit', [SatuanController::class, 'edit'])->name('data-satuan.edit');

        // ROUTE VERIFIKASI PEMINJAMAN
        Route::get('verifikasi-peminjaman', [PeminjamanController::class, 'index'])->name('verifikasi');
    });

    Route::middleware(['UserAccess:Staff'])->group(function () {});
});

Route::middleware(['UserAccess:Staff'])->group(function () {
    // ROUTE DATA BARANG
    Route::get('data-barang', [ProdukController::class, 'barang'])->name('data-barang');
    Route::post('data-barang/proses', [ProdukController::class, 'storeBarang'])->name('data-barang.proses');
    Route::put('data-barang/{id}/edit', [ProdukController::class, 'editBarang'])->name('data-barang.edit');
    Route::delete('data-barang/{id}/delete', [ProdukController::class, 'deleteBarang'])->name('data-barang.delete');
});

Route::middleware(['auth:mahasiswa'])->group(function () {
    Route::get('home', [HomeController::class, 'index']);
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [MahasiswaController::class, 'home'])->name('mahasiswa');
    Route::get('katalog', [MahasiswaController::class, 'katalog'])->name('mahasiswa.katalog');
    Route::get('katalog/peminjaman-barang/{name}', [MahasiswaController::class, 'viewbarang'])->name('mahasiswa.viewbarang');
    Route::get('informasi', [MahasiswaController::class, 'informasi'])->name('mahasiswa.informasi');
});

// Route::get('/', [MahasiswaController::class, 'home'])->name('mahasiswa');

// // Authentication Routes
// Route::get('login', [LoginController::class, 'index'])->name('login');
// Route::post('login-proses', [LoginController::class, 'store'])->name('login.store');
// Route::get('register', [RegisterController::class, 'index'])->name('register');
// Route::post('register-proses', [RegisterController::class, 'store'])->name('register.store');

// Route::middleware(['auth'])->group(function () {
//     Route::get('logout', [LoginController::class, 'logout'])->name('logout');

//     // Admin Routes
//     Route::middleware(['role:' . Role::ADMIN])->group(function () {

//         Route::prefix('admin')->group(function () {

//             Route::get('', [AdminController::class, 'index'])->name('admin');

//             // ROUTE BUAT TAMBAH USERS
//             Route::get('kelola-users/users', [AdminController::class, 'users'])->name('admin.users');
//             Route::get('kelola-users/users/create', [AdminController::class, 'addUsers'])->name('admin.users.create');
//             Route::put('kelola-users/users/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
//             Route::delete('kelola-users/users/{id}/delete', [AdminController::class, 'destroy'])->name('admin.users.delete');
//             Route::post('kelola-users/users/create', [AdminController::class, 'storeUsers'])->name('admin.users.proses');

//             // ROUTE BUAT TAMBAH PRODUK ALAT LAB
//             Route::get('alat-dan-bahan/barang', [ProdukController::class, 'index'])->name('admin.barang');
//             Route::get('alat-dan-bahan/barang/data', [ProdukController::class, 'getBarangs'])->name('admin.barang.data');
//             Route::post('alat-dan-bahan/barang/proses', [ProdukController::class, 'storeBarang'])->name('admin.barang.proses');
//             Route::delete('alat-dan-bahan/barang/{barang}/delete', [ProdukController::class, 'hapus'])->name('admin.barang.hapus');

//             // ROUTE BUAT TAMBAH KATEGORI
//             Route::get('alat-dan-bahan/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
//             Route::post('alat-dan-bahan/kategori/proses', [KategoriController::class, 'store'])->name('admin.kategori.proses');
//             Route::put('alat-dan-bahan/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
//             Route::delete('alat-dan-bahan/kategori/{kategori}/hapus', [KategoriController::class, 'hapus'])->name('admin.kategori.hapus');

//             // ROUTE BUAT TAMBAH SATUAN
//             Route::get('alat-dan-bahan/satuan', [SatuanController::class, 'index'])->name('admin.satuan');
//             Route::post('alat-dan-bahan/satuan/proses', [SatuanController::class, 'store'])->name('admin.satuan.proses');
//             Route::delete('alat-dan-bahan/satuan/{satuan}/delete', [SatuanController::class, 'hapus'])->name('admin.satuan.hapus');
//             Route::put('alat-dan-bahan/satuan/{satuan}/edit', [SatuanController::class, 'edit'])->name('admin.satuan.edit');

//             // ROUTE BUAT VERIFIKASI PEMINJAMAN
//             Route::get('verifikasi-peminjaman', [PeminjamanController::class, 'index'])->name('admin.peminjaman');
//         });
//     });

//     Route::middleware(['role:' . Role::DOSEN])->group(function () {
//         Route::get('dosen', [DosenController::class, 'index'])->name('dosen');
//     });

//     // Mahasiswa Routes
//     Route::middleware(['role:' . Role::MAHASISWA])->group(function () {
//         Route::get('/', [MahasiswaController::class, 'home'])->name('mahasiswa');
//         Route::get('katalog', [MahasiswaController::class, 'katalog'])->name('mahasiswa.katalog');
//         Route::get('katalog/peminjaman-barang/{name}', [MahasiswaController::class, 'viewbarang'])->name('mahasiswa.viewbarang');
//         Route::get('informasi', [MahasiswaController::class, 'informasi'])->name('mahasiswa.informasi');
//     });
// });
