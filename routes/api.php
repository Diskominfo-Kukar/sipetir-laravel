<?php

use App\Models\Paket\Paket;
use App\Traits\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test-postgres', function () {
    return Notifikasi::sendTo('000307a6-1746-4199-91f6-d341a84523bc', Paket::class, '00051b28-1e3e-471f-a895-54e08e44c610', route('paket.berita_acara_TTE_ppk'), 'Paket baru perlu tandatangan');
});

Route::get('/test-mysql', function () {
    return Paket::with('ppk', 'satuan_kerja', 'pokmil.panitia.user', 'pokmil.satuan_kerja')
        ->where('ppk_id', '!=', null)
        ->where('pokmil_id', '!=', null)
        ->where('satker_id', '!=', null)
        ->limit(10)
        ->get();
});
