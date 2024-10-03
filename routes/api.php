<?php

use App\Traits\TTE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::post('sign', function (Request $request) {
    $file = $request->file;

    $fileStorage = Storage::disk('public')->putFileAs('blm_signed', $file, 'ini_data.pdf');

    $suratTugasFile = Storage::disk('public')->get($fileStorage);

    $fileNameSuratTugas = basename($fileStorage);

    $tteSuksesSuratTugas = TTE::signDocument($suratTugasFile, $fileNameSuratTugas);

    if ($tteSuksesSuratTugas) {
        return 'Paket diserahkan kepada panitia untuk di review';
    } else {
        return 'Paket gagal di TTE';
    }
});
