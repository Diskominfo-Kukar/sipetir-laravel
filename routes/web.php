<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\AkunController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Master\JabatanController;
use App\Http\Controllers\Master\JenisDokumenController;
use App\Http\Controllers\Master\KategoriReviewController;
use App\Http\Controllers\Master\OpdController;
use App\Http\Controllers\Master\PanitiaController;
use App\Http\Controllers\Master\PpkController;
use App\Http\Controllers\Master\QuestionController;
use App\Http\Controllers\Paket\PaketController;
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

    //jenis-dokumen
    Route::resource('jenis-dokumen', JenisDokumenController::class);
    Route::get('/jenis-dokumen-get-data', [JenisDokumenController::class, 'getData'])->name('jenis-dokumen.get-data');

    //Question
    Route::resource('question', QuestionController::class);
    Route::get('/question-get-data', [QuestionController::class, 'getData'])->name('question.get-data');

    //pkk
    Route::resource('ppk', PpkController::class);
    Route::get('/ppk-get-data', [PpkController::class, 'getData'])->name('ppk.get-data');

    //jabatan
    Route::resource('jabatan', JabatanController::class);
    Route::get('/jabatan-get-data', [JabatanController::class, 'getData'])->name('jabatan.get-data');

    //opd
    Route::resource('opd', OpdController::class);
    Route::get('/opd-get-data', [OpdController::class, 'getData'])->name('opd.get-data');

    //panitia
    Route::resource('panitia', PanitiaController::class);
    Route::get('/panitia-get-data', [PanitiaController::class, 'getData'])->name('panitia.get-data');

    //Paket
    Route::resource('paket', PaketController::class);
    Route::get('/paket-get-data', [PaketController::class, 'getData'])->name('paket.get-data');
});

require __DIR__ . '/auth.php';
