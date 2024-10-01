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
            return self::logError('Gagal Membuka File', 'Gagal membuka dokumen untuk penandatanganan.');
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
            return self::handleSuccess($response, $dokumen);
        }

        return self::handleError($response);
    }

    private static function handleSuccess($response, $dokumen)
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
            Storage::disk('local')->put('public/'.$newDokumen, $responseDownload);

            return self::logSuccess('TTE Berhasil', 'Berhasil Menandatangani Dokumen Secara Digital');
        }

        return self::logError('Gagal Mengunduh Dokumen', 'Gagal mengunduh dokumen yang telah ditandatangani.');
    }

    private static function handleError($response)
    {
        $code         = $response->status();
        $body         = $response->json();
        $errorMessage = $body['error'] ?? 'Unknown error';

        switch ($code) {
            case 404:
                return self::logError('Server Tidak Ditemukan', 'Server Tidak Ditemukan');
            case 500:
                return self::logError('Server Maintenance', 'Server Sedang Dalam Perbaikan');
            default:
                return self::logError('TTE Gagal (code: '.$code.')', $errorMessage);
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
