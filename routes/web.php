<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\AkunController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Master\JabatanController;
use App\Http\Controllers\Master\JenisDokumenController;
use App\Http\Controllers\Master\KategoriReviewController;
use App\Http\Controllers\Master\OpdController;
use App\Http\Controllers\Master\OtpController;
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

Route::middleware(['auth', 'role_or_permission:Admin|superadmin'])->prefix('master')->group(function () {
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

    //OTP
    Route::resource('otp', OtpController::class);
    Route::get('/otp-get-data', [OtpController::class, 'getData'])->name('otp.get-data');
});

Route::middleware(['auth', 'role_or_permission:Admin|superadmin|Panitia|PPK|Kepala BPBJ'])->group(function () {
    Route::resource('paket', PaketController::class);
    Route::controller(PaketController::class)->name('paket.')->group(function () {
        Route::get('/paket-get-data', 'getData')->name('get-data');
        Route::post('/upload-berkas', 'uploadBerkas')->name('uploadBerkas');
        Route::post('/upload-ttd', 'uploadTtd')->name('uploadTtd');
        Route::post('/upload-berkas-submit', 'uploadAllBerkas')->name('uploadAllBerkas');
        Route::post('/upload-berkas-verif', 'VerifBerkas')->name('VerifBerkas');
        Route::get('/roll', 'roll')->name('roll');
        Route::post('/progres-surat_tugas', 'progres_surat_tugas')->name('progres_surat_tugas');
        Route::post('/upload-surat_tugas', 'generate_surat_tugas')->name('generate_surat_tugas');
        Route::post('/review', 'review')->name('review');
        Route::post('/answer_question', 'answer_question')->name('answer_question');
        Route::post('/answer_chr', 'answer_chr')->name('answer_chr');
        Route::post('/progres-berita_acara', 'progres_berita_acara')->name('progres_berita_acara');
        Route::post('/berita_acara_TTE_panitia', 'berita_acara_TTE_panitia')->name('berita_acara_TTE_panitia');
        Route::post('/berita_acara_TTE_ppk', 'berita_acara_TTE_ppk')->name('berita_acara_TTE_ppk');
        Route::post('/generate-berita_acara', 'generate_berita_acara')->name('generate_berita_acara');
        Route::post('/upload-berita_acara_1', 'upload_berita_acara_1')->name('upload_berita_acara_1');
        Route::post('/upload-berita_acara_2', 'upload_berita_acara_2')->name('upload_berita_acara_2');
        Route::post('/upload-berita_acara_3', 'upload_berita_acara_3')->name('upload_berita_acara_3');
    });
});

require __DIR__.'/auth.php';
