<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\bukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;

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

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Rute untuk pendaftaran pengguna
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('Unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');

Route::middleware(['auth'])->prefix('master-data')->name('master.data.')->group(function () {
    Route::resource('kategori', KategoriController::class)->middleware(['role:super_admin']);

    Route::middleware(['role:super_admin,admin'])->prefix('buku')->name('buku.')->group(function () {
        Route::get('/', [bukuController::class, 'index'])->name('index');
        Route::get('/create', [bukuController::class, 'create'])->name('create');
        Route::get('/show/{buku}', [bukuController::class, 'show'])->name('show');
        Route::post('/store', [bukuController::class, 'store'])->name('store');
        Route::get('/{buku}/edit', [bukuController::class, 'edit'])->name('edit');
        Route::put('/{buku}', [bukuController::class, 'update'])->name('update');
        Route::delete('/{buku}', [bukuController::class, 'destroy'])->name('destroy');
    });

    Route::middleware(['role:pengguna,admin,super_admin'])->prefix('penjualan')->name('penjualan.')->group(function () {
        Route::get('/', [PenjualanController::class, 'index'])->name('index');
        Route::get('/create', [PenjualanController::class, 'create'])->name('create');
        Route::post('/store', [PenjualanController::class, 'store'])->name('store');
        Route::get('/show/{penjualan}', [PenjualanController::class, 'show'])->name('show');
        Route::get('/{penjualan}/edit', [PenjualanController::class, 'edit'])->name('edit');
        Route::put('/{penjualan}', [PenjualanController::class, 'update'])->name('update');
        Route::delete('/{penjualan}', [PenjualanController::class, 'destroy'])->name('destroy');
    });

    Route::middleware(['role:super_admin'])->prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware(['auth'])->prefix('profil')->name('profil.')->group(function () {
    Route::get('user', [ProfilController::class, 'userIndex'])->name('index');
    Route::put('/{user}', [ProfilController::class, 'update'])->name('update');
});
