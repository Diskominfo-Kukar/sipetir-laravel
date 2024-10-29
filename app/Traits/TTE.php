<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TTE
{
    public static function signDocument($dokumen, $fileName, $nik, $passphrase)
    {
        if (config('app.env') == 'local') {
            $nik        = config('tte.username');
            $passphrase = config('tte.passphrase');
        }

        ini_set('max_execution_time', '300');

        $url = config('tte.url').'/api/sign/pdf';

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic '.config('tte.key'),
            ])
                ->withoutVerifying()
                ->attach('file', $dokumen, $fileName)
                ->post($url, [
                    'nik'        => $nik,
                    'passphrase' => $passphrase,
                    'tampilan'   => 'invisible',
                ]);
        } catch (\Exception $th) {
            return $th->getMessage();
        }

        if ($response->successful()) {
            //$dokumenId     = $response->header('id_dokumen');
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            $signedFilePathStore = 'documents/signed/';
            //$signedFileName      = $signedFilePathStore.$dokumenId.'-'.pathinfo($fileName, PATHINFO_FILENAME).'_signed.'.$fileExtension;
            $signedFileName = $signedFilePathStore.pathinfo($fileName, PATHINFO_FILENAME).'_signed.'.$fileExtension;

            Storage::disk('public')->put($signedFileName, $response->body());

            //return Storage::disk('local')->url($signedFileName);
            return $signedFileName;
        }

        return null;
    }

    // private static function reDownloadSignedDocument($dokumenId)
    // {
    //     $urlDownload = config('tte.url').'/api/sign/download/'.$dokumenId;

    //     $response = Http::withHeaders([
    //         'Authorization' => 'Basic '.config('tte.key'),
    //     ])
    //         ->withoutVerifying()
    //         ->get($urlDownload);

    //     if ($response->successful()) {
    //         $contentDisposition = $response->header('Content-Disposition');
    //         $fileExtension      = self::getFileExtensionFromContentDisposition($contentDisposition);
    //         $signedFileName     = $dokumenId.'_signed.'.$fileExtension;

    //         $filePath = 'public/'.$signedFileName; // Save with new name
    //         Storage::disk('local')->put($filePath, $response->body());

    //         return Storage::disk('local')->url($filePath);
    //     }

    //     return null;
    // }

    // private static function getFileExtensionFromContentDisposition($contentDisposition)
    // {
    //     if (preg_match('/filename[^;=\n]*=((["\']).*?\2|[^;\n]*)/', $contentDisposition, $matches)) {
    //         $fileName = trim($matches[1], '"');

    //         return pathinfo($fileName, PATHINFO_EXTENSION);
    //     }

    //     return null;
    // }
}
