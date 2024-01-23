<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\AkunController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Master\KategoriReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('dashboard');
    });

    Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
    Route::post('/akun', [AkunController::class, 'store'])->name('akun.store');
    Route::get('/akun/password', [AkunController::class, 'passwordEdit'])->name('akun.password.edit');
    Route::post('/akun/password', [AkunController::class, 'passwordUpdate'])->name('akun.password.update');
});

Route::middleware(['auth', 'role_or_permission:admin|superadmin'])->prefix('master')->group(function () {
    Route::controller(UserController::class)->prefix('user')->name('user.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::patch('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');
        Route::get('/get-data', 'getData')->name('get-data');
    });

    //kategori-review
    Route::resource('kategori-review', KategoriReviewController::class);
    Route::get('/kategori-review-get-data', [KategoriReviewController::class, 'getData'])->name('kategori-review.get-data');
});

require __DIR__.'/auth.php';
