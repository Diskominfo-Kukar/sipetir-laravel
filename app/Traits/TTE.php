<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TTE
{
    public static function sign($dokumen, $namaFile)
    {
        ini_set('max_execution_time', '300');

        $url         = config('tte.url').'/api/sign/pdf';
        $dokumenOpen = fopen(public_path($dokumen), 'r');

        if (! $dokumenOpen) {
            self::logError('Gagal Membuka File', 'Gagal membuka dokumen untuk penandatanganan.');

            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic '.config('tte.key'),
            ])
                ->withoutVerifying()
                ->attach('file', $dokumenOpen, $namaFile)
                ->post($url, [
                    'nik'        => request()->nik,
                    'passphrase' => request()->passphrase,
                    'tampilan'   => 'invisible',
                ]);
        } finally {
            fclose($dokumenOpen);
        }

        if ($response->successful()) {
            return self::handleSuccess($response, $dokumen, $namaFile);
        }

        self::handleError($response);

        return false;
    }

    private static function handleSuccess($response, $dokumen, $namaFile)
    {
        $dokumenId   = $response->header('id_dokumen');
        $newDokumen  = str_replace('/storage', '', $dokumen);
        $urlDownload = config('tte.url').'/api/sign/download/'.$dokumenId;

        $responseDownload = Http::withHeaders([
            'Authorization' => 'Basic '.config('tte.key'),
        ])
            ->withoutVerifying()
            ->get($urlDownload);

        if ($responseDownload->successful()) {
            // Extract the file extension and rename the file
            $fileExtension  = pathinfo($namaFile, PATHINFO_EXTENSION);
            $signedFileName = pathinfo($namaFile, PATHINFO_FILENAME).'_signed.'.$fileExtension;

            $filePath = 'public/'.$signedFileName; // Save with new name
            Storage::disk('local')->put($filePath, $responseDownload);

            self::logSuccess('TTE Berhasil', 'Berhasil Menandatangani Dokumen Secara Digital');

            return Storage::disk('local')->path($filePath);
        }

        self::logError('Gagal Mengunduh Dokumen', 'Gagal mengunduh dokumen yang telah ditandatangani.');

        return false;
    }

    private static function handleError($response): void
    {
        $code         = $response->status();
        $body         = $response->json();
        $errorMessage = $body['error'] ?? 'Unknown error';

        switch ($code) {
            case 404:
                self::logError('Server Tidak Ditemukan', 'Server Tidak Ditemukan');
                break;
            case 500:
                self::logError('Server Maintenance', 'Server Sedang Dalam Perbaikan');
                break;
            default:
                self::logError('TTE Gagal (code: '.$code.')', $errorMessage);
                break;
        }
    }

    private static function logError($title, $message)
    {
        return [
            'title'      => $title,
            'body'       => $message,
            'scope'      => 'tte',
            'type'       => 'error',
            'created_by' => auth()->user()->id,
        ];
    }

    private static function logSuccess($title, $message)
    {
        return [
            'title' => $title,
            'body'  => $message,
            'scope' => 'tte',
            'type'  => 'success',
        ];
    }
}
