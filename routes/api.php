<?php

use App\Models\Paket\Paket;
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
    //
});

Route::get('/test-mysql', function () {
    return Paket::with('pokmil.panitia.user', 'pokmil.satuan_kerja', 'ppk')
        ->where('ppk_id', '!=', null)
        ->where('pokmil_id', '!=', null)
        ->limit(10)
        ->get();
});
