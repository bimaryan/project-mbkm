<?php

use App\Http\Controllers\WEB\Admin\AdminController;
use App\Http\Controllers\WEB\Auth\LoginController;
use App\Http\Controllers\WEB\Auth\RegisterController;
use App\Http\Controllers\WEB\Mahasiswa\MahasiswaController;
use App\Http\Controllers\WEB\Staff\StaffController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login-proses', [LoginController::class, 'store'])->name('login.store');
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register-proses', [RegisterController::class, 'store'])->name('register.store');

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(['role:' . Role::ADMIN])->group(function () {
        Route::get('admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('admin/users/create', [AdminController::class, 'addUsers'])->name('admin.users.create');
        Route::post('admin/users/create', [AdminController::class, 'storeUsers'])->name('admin.users.proses');
    });

    Route::middleware(['role:' . Role::STAFF])->group(function () {
        Route::get('staff', [StaffController::class, 'index'])->name('staff');
    });

    Route::middleware(['role:' . Role::MAHASISWA])->group(function () {
        Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    });
});
