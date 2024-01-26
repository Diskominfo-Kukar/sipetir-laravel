<?php

namespace Database\Seeders;

use App\Models\Master\JenisOpd;
use App\Models\Master\Opd;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DataOpdSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $api_isb     = env('API_ISB');
        $api_key_opd = env('API_KEY_OPD');
        $response    = Http::get("{$api_isb}{$api_key_opd}");

        $jsonData = $response->json();

        foreach ($jsonData as $value) {
            $jenis_opd = JenisOpd::firstOrCreate(
                ['nama' => $value['jenis_satker'], 'keterangan' => $value['jenis_satker']]
            );

            Opd::firstOrCreate(
                [
                    'kode'         => $value['kd_satker'],
                    'kode_str'     => $value['kd_satker_str'],
                    'nama'         => $value['nama_satker'],
                    'status'       => $value['status_satker'],
                    'jenis_opd_id' => $jenis_opd->id,
                ]
            );

            $this->command->info('Creating '.$value['nama_satker']);
        }
    }
}
