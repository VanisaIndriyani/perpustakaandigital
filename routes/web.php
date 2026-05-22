<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\KoleksiController::class, 'home'])->name('home');

Route::get('/jurnal', [\App\Http\Controllers\KoleksiController::class, 'index'])->defaults('jenisSlug', 'jurnal')->name('koleksi.jurnal');
Route::get('/e-jurnal', [\App\Http\Controllers\KoleksiController::class, 'index'])->defaults('jenisSlug', 'e-jurnal')->name('koleksi.ejurnal');
Route::get('/buku', [\App\Http\Controllers\KoleksiController::class, 'index'])->defaults('jenisSlug', 'buku')->name('koleksi.buku');
Route::get('/e-book', [\App\Http\Controllers\KoleksiController::class, 'index'])->defaults('jenisSlug', 'e-book')->name('koleksi.ebook');
Route::get('/skripsi', [\App\Http\Controllers\KoleksiController::class, 'index'])->defaults('jenisSlug', 'skripsi')->name('koleksi.skripsi');
Route::get('/ppl-kk', [\App\Http\Controllers\KoleksiController::class, 'index'])->defaults('jenisSlug', 'ppl-kk')->name('koleksi.pplkk');

Route::get('/koleksi/{koleksi}', [\App\Http\Controllers\KoleksiController::class, 'show'])->name('koleksi.show');

Route::get('/login', [\App\Http\Controllers\Mahasiswa\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\Mahasiswa\AuthController::class, 'login'])->name('login.store');
Route::get('/register', [\App\Http\Controllers\Mahasiswa\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [\App\Http\Controllers\Mahasiswa\AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [\App\Http\Controllers\Mahasiswa\AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'mahasiswa'])->name('mahasiswa.')->group(function () {
    Route::get('/akun', \App\Http\Controllers\Mahasiswa\DashboardController::class)->name('dashboard');
    Route::get('/peminjaman', [\App\Http\Controllers\Mahasiswa\PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman', [\App\Http\Controllers\Mahasiswa\PeminjamanController::class, 'store'])->name('peminjaman.store');

    Route::get('/turnitin', [\App\Http\Controllers\Mahasiswa\TurnitinController::class, 'index'])->name('turnitin.index');
    Route::get('/turnitin/submit', [\App\Http\Controllers\Mahasiswa\TurnitinController::class, 'create'])->name('turnitin.create');
    Route::post('/turnitin', [\App\Http\Controllers\Mahasiswa\TurnitinController::class, 'store'])->name('turnitin.store');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.store');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');
        Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

        Route::get('/kategori', [\App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/create', [\App\Http\Controllers\Admin\KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori', [\App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{kategori}/edit', [\App\Http\Controllers\Admin\KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{kategori}', [\App\Http\Controllers\Admin\KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [\App\Http\Controllers\Admin\KategoriController::class, 'destroy'])->name('kategori.destroy');

        Route::get('/koleksi', [\App\Http\Controllers\Admin\KoleksiController::class, 'index'])->name('koleksi.index');
        Route::get('/koleksi/create', [\App\Http\Controllers\Admin\KoleksiController::class, 'create'])->name('koleksi.create');
        Route::post('/koleksi', [\App\Http\Controllers\Admin\KoleksiController::class, 'store'])->name('koleksi.store');
        Route::get('/koleksi/{koleksi}/edit', [\App\Http\Controllers\Admin\KoleksiController::class, 'edit'])->name('koleksi.edit');
        Route::put('/koleksi/{koleksi}', [\App\Http\Controllers\Admin\KoleksiController::class, 'update'])->name('koleksi.update');
        Route::delete('/koleksi/{koleksi}', [\App\Http\Controllers\Admin\KoleksiController::class, 'destroy'])->name('koleksi.destroy');

        Route::get('/peminjaman', [\App\Http\Controllers\Admin\PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::put('/peminjaman/{peminjaman}', [\App\Http\Controllers\Admin\PeminjamanController::class, 'update'])->name('peminjaman.update');

        Route::get('/turnitin', [\App\Http\Controllers\Admin\TurnitinController::class, 'index'])->name('turnitin.index');
        Route::put('/turnitin/{turnitinSubmission}', [\App\Http\Controllers\Admin\TurnitinController::class, 'update'])->name('turnitin.update');
    });
});
