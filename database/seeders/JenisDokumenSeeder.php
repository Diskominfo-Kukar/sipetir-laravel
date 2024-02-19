<?php

namespace Database\Seeders;

use App\Models\Master\JenisDokumen;
use Illuminate\Database\Seeder;

class JenisDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisDokumen = [
            'RKA / DPA',
            'Surat Permohonan Tender/Seleksi',
            'SK PPK',
            'HPS',
            'Spesifikasi Teknis/KAK',
            'Lampiran (Draft Kontrak, Gambar, Uraian Pekerjaan, Dll)',
        ];

        foreach ($jenisDokumen as $value) {
            JenisDokumen::create([
                'nama' => $value,
            ]);
        }
    }
}
