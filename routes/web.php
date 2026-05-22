<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\KoleksiController::class, 'home'])->name('home');

Route::get('/jurnal', [\App\Http\Controllers\KoleksiController::class, 'index'])->defaults('jenisSlug', 'jurnal')->name('koleksi.jurnal');
Route::get('/e-jurnal', [\App\Http\Controllers\KoleksiController::class, 'index'])->defaults('jenisSlug', 'e-jurnal')->name('koleksi.ejurnal');
Route::get('/buku', [\App\Http\Controllers\KoleksiController::class, 'index'])->defaults('jenisSlug', 'buku')->name('koleksi.buku');
Route::get('/e-book', [\App\Http\Controllers\KoleksiController::class, 'index'])->defaults('jenisSlug', 'e-book')->name('koleksi.ebook');
Route::get('/skripsi', [\App\Http\Controllers\KoleksiController::class, 'index'])->defaults('jenisSlug', 'skripsi')->name('koleksi.skripsi');

Route::get('/koleksi/{koleksi}', [\App\Http\Controllers\KoleksiController::class, 'show'])->name('koleksi.show');

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.store');
    });

    Route::middleware('auth')->group(function () {
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
    });
});
