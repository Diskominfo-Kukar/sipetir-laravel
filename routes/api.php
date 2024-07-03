<?php

use App\Models\External\Epns\Paket as PaketExternal;
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
    return PaketExternal::limit(10)->get();
});

Route::get('/test-mysql', function () {
    return Paket::limit(10)->get();
});
