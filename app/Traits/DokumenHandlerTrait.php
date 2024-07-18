<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

trait DokumenHandlerTrait
{
    public static function handlerTte($dokumen, $namaFile)
    {
        ini_set('max_execution_time', '300');
        // set_time_limit()
        $url         = env('TTE_URL').'/api/sign/pdf';
        $dokumenOpen = fopen(public_path($dokumen), 'r');
        $response    = Http::withHeaders([
            'Authorization' => 'Basic '.env('TTE_API_KEY'),
        ])
            ->withoutVerifying()
            ->attach('file', $dokumenOpen, $namaFile)
            ->post($url, [
                'nik'        => request()->nik,
                'passphrase' => request()->passphrase,
                'tampilan'   => 'invisible',
            ]);

        if ($response->successful()) {
            $dokumenId        = $response->header('id_dokumen');
            $newDokumen       = str_replace('/storage', '', $dokumen);
            $urlDownload      = env('TTE_URL').'/api/sign/download/'.$dokumenId;
            $responseDownload = Http::withHeaders([
                'Authorization' => 'Basic '.env('TTE_API_KEY'),
            ])
                ->withoutVerifying()
                ->get($urlDownload);

            if ($responseDownload->successful()) {
                Storage::disk('local')->put('public/'.$newDokumen, $responseDownload);
                $dataLog = [
                    'title' => 'TTE Berhasil',
                    'body'  => 'Berhasil Menandatangni Dokumen Secara Digital',
                    'scope' => 'tte',
                    'type'  => 'success',
                ];
            }
        }

        if ($response->failed()) {
            $code = $response->status();
            $body = $response->json();

            $dataLog = [
                'title' => 'TTE Gagal (code: '.$code.')',
                'body'  => $body['error'],
                'scope' => 'tte',
                'type'  => 'error',
            ];

            if ($code === 404) {
                $dataLog = [
                    'title' => 'Server Tidak Ditemukan (code: '.$code.')',
                    'body'  => 'Server Tidak Ditemukan',
                    'scope' => 'tte',
                    'type'  => 'error',
                ];
            }

            if ($code === 500) {
                $dataLog = [
                    'title' => 'Server Maintenance (code: '.$code.')',
                    'body'  => 'Server Sedang Dalam Perbaikan',
                    'scope' => 'tte',
                    'type'  => 'error',
                ];
            }

            $dataLog['created_by'] = auth()->user()->id;
        }

        return $dataLog;
    }
}
