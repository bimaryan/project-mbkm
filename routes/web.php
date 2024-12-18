<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\DashboardController;
use App\Http\Controllers\WEB\Auth\LoginController;
use App\Http\Controllers\WEB\Auth\ForgotPasswordController;
use App\Http\Controllers\WEB\Admin\AdminController;
use App\Http\Controllers\WEB\Admin\DokumenSpoController;
use App\Http\Controllers\WEB\Admin\DosenController;
use App\Http\Controllers\WEB\Admin\LinkApiController;
use App\Http\Controllers\WEB\Admin\MahasiswaController;
use App\Http\Controllers\WEB\Admin\MataKuliahController;
use App\Http\Controllers\WEB\Staff\RuanganController;
use App\Http\Controllers\WEB\Staff\ProdukController;
use App\Http\Controllers\WEB\Staff\SatuanController;
use App\Http\Controllers\WEB\Staff\KategoriController;
use App\Http\Controllers\WEB\Staff\PeminjamanController;
use App\Http\Controllers\WEB\Staff\LaporanController;
use App\Http\Controllers\WEB\Peminjaman\KeranjangController;
use App\Http\Controllers\WEB\Peminjaman\ProfileController;
use App\Http\Controllers\WEB\Peminjaman\HomeController;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('login-process', [LoginController::class, 'login'])->name('login-process');

Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
Route::post('forgot-password-process', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password-process');

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password-process/{token}', [ForgotPasswordController::class, 'resetPasswordProcess'])->name('reset-password-process');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    // ROUTE LAPORAN PEMINJAMAN
    Route::get('laporan-peminjaman', [LaporanController::class, 'index'])->name('laporan');
    Route::get('export-laporan', [LaporanController::class, 'exportLaporan'])->name('laporan.export');

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

            Route::post('import-kelas', [MahasiswaController::class, 'importKelas'])->name('import.kelas');
            Route::post('import-mahasiswa', [MahasiswaController::class, 'importMahasiswa'])->name('import.mahasiswa');
            Route::post('/import-matakuliah', [MataKuliahController::class, 'importMatkul'])->name('import.matakuliah');
            Route::get('/export-mahasiswa', [MahasiswaController::class, 'exportMahasiswa'])->name('export.mahasiswa');


            // ROUTE DATA DOSEN
            Route::get('/data-dosen', [DosenController::class, 'dosen'])->name('data-dosen');
            Route::post('/data-dosen/proses', [DosenController::class, 'storeDosen'])->name('data-dosen.proses');
            Route::put('/data-dosen/{dosen}/edit', [DosenController::class, 'editDosen'])->name('data-dosen.edit');
            Route::delete('/data-dosen/{dosen}/hapus', [DosenController::class, 'deleteDosen'])->name('data-dosen.delete');
            Route::post('/import-dosen', [DosenController::class, 'importDosen'])->name('import.dosen');
        });

        // ROUTE DATA KELAS
        Route::get('/data-kelas', [MahasiswaController::class, 'kelas'])->name('data-kelas');
        Route::post('/data-kelas/proses', [MahasiswaController::class, 'storeKelas'])->name('data-kelas.proses');
        Route::delete('/data-kelas/{kelas}/hapus', [MahasiswaController::class, 'deleteKelas'])->name('data-kelas.delete');
        Route::put('/data-kelas/{kelas}/edit', [MahasiswaController::class, 'editKelas'])->name('data-kelas.edit');

        // ROUTE DATA MATAKULIAH
        Route::get('/data-mata-kuliah', [MataKuliahController::class, 'matakuliah'])->name('data-mata-kuliah');
        Route::post('/data-mata-kuliah/proses', [MataKuliahController::class, 'storeMatakuliah'])->name('data-mata-kuliah.proses');
        Route::delete('/data-mata-kuliah/{matakuliah}/hapus', [MataKuliahController::class, 'deleteMatakuliah'])->name('data-mata-kuliah.delete');
        Route::put('/data-mata-kuliah/{matakuliah}/edit', [MataKuliahController::class, 'editMatakuliah'])->name('data-mata-kuliah.edit');

        // ROUTE DATA SPO
        Route::get('/data-spo', [DokumenSpoController::class, 'dokumenSPO'])->name('data-spo');
        Route::post('/data-spo/proses', [DokumenSpoController::class, 'storeSPO'])->name('data-spo.proses');
        Route::delete('/data-spo/{dokumen}/hapus', [DokumenSpoController::class, 'deleteSPO'])->name('data-spo.delete');
        Route::put('/data-spo/{spo}/edit', [DokumenSpoController::class, 'editSPO'])->name('data-spo.edit');
        Route::get('/download/{dokumen}', [DokumenSpoController::class, 'downloadSPO'])->name('download.spo');

        // ROUTE DATA LINK API
        Route::resource('settings/link-api', LinkApiController::class);
    });

    Route::middleware(['UserAccess:Staff'])->group(function () {
        Route::prefix('data-alat-dan-bahan/')->group(function () {
            // ROUTE DATA BARANG
            Route::get('data-barang', [ProdukController::class, 'barang'])->name('data-barang');
            Route::post('data-barang/proses', [ProdukController::class, 'storeBarang'])->name('data-barang.proses');
            Route::put('data-barang/{barang}/edit', [ProdukController::class, 'editBarang'])->name('data-barang.edit');
            Route::delete('data-barang/{barang}/hapus', [ProdukController::class, 'deleteBarang'])->name('data-barang.hapus');
            Route::post('data-barang/import', [ProdukController::class, 'importBarang'])->name('data-barang.import');

            // ROUTE DATA KATEGORI
            Route::get('data-kategori', [KategoriController::class, 'kategori'])->name('data-kategori');
            Route::post('data-kategori/proses', [KategoriController::class, 'storeKategori'])->name('data-kategori.proses');
            Route::put('data-kategori/{kategori}/edit', [KategoriController::class, 'editKategori'])->name('data-kategori.edit');
            Route::delete('data-kategori/{kategori}/hapus', [KategoriController::class, 'deleteKategori'])->name('data-kategori.hapus');
            Route::post('data-kategori/import', [KategoriController::class, 'importKategori'])->name('data-kategori.import');

            // ROUTE DATA SATUAN
            Route::get('data-satuan', [SatuanController::class, 'satuan'])->name('data-satuan');
            Route::post('data-satuan/proses', [SatuanController::class, 'storeSatuan'])->name('data-satuan.proses');
            Route::delete('data-satuan/{satuan}/hapus', [SatuanController::class, 'deleteSatuan'])->name('data-satuan.hapus');
            Route::put('data-satuan/{satuan}/edit', [SatuanController::class, 'editSatuan'])->name('data-satuan.edit');
            Route::post('data-satuan/import', [SatuanController::class, 'importSatuan'])->name('data-satuan.import');
        });

        // ROUTE DATA RUANGAN
        Route::get('data-ruangan', [RuanganController::class, 'ruangan'])->name('data-ruangan');
        Route::post('data-ruangan/proses', [RuanganController::class, 'storeRuangan'])->name('data-ruangan.proses');
        Route::delete('data-ruangan/{ruangan}/hapus', [RuanganController::class, 'deleteRuangan'])->name('data-ruangan.hapus');
        Route::put('data-ruangan/{ruangan}/edit', [RuanganController::class, 'editRuangan'])->name('data-ruangan.edit');
        Route::post('data-ruangan/import', [RuanganController::class, 'importRuangan'])->name('data-ruangan.import');

        // ROUTE VERIFIKASI PEMINJAMAN
        Route::get('verifikasi-peminjaman', [PeminjamanController::class, 'index'])->name('verifikasi');
        Route::put('verifikasi-peminjaman/{peminjaman}/pinjam', [PeminjamanController::class, 'update'])->name('verifikasi.update');
        Route::put('verifikasi-peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembali'])->name('verifikasi.kembali');
    });
});

Route::group(['middleware' => ['multiGuard:dosen,mahasiswa']], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::get('katalog', [HomeController::class, 'katalog'])->name('katalog');
    Route::get('katalog/{nama_barang}', [HomeController::class, 'viewbarang'])->name('viewbarang');
    Route::get('keranjang', [KeranjangController::class, 'index'])->name('keranjang');
    Route::get('katalog/peminjaman-barang/{nama_barang}', [HomeController::class, 'viewbarang'])->name('viewbarang');
    Route::post('peminjaman/{barang}/{stock}', [HomeController::class, 'peminjaman'])->name('mahasiswa.peminjaman');
    Route::get('informasi', [HomeController::class, 'informasi'])->name('mahasiswa.informasi');
    Route::get('riwayat', [HomeController::class, 'riwayat'])->name('mahasiswa.riwayat');

    Route::prefix('profile/')->group(function () {
        Route::get('', [ProfileController::class, 'viewProfile'])->name('profile');
        Route::get('ubah-kata-sandi', [ProfileController::class, 'ViewUbahKataSandi'])->name('view-ubah-kata-sandi');

        Route::put('edit-profile', [ProfileController::class, 'update'])->name('editProfile');
        Route::put('ubah-kata-sandi', [ProfileController::class, 'ubahKataSandi'])->name('ubah-kata-sandi');
    });
});
