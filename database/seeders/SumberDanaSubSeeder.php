<?php

namespace Database\Seeders;

use App\Models\Master\SumberDana;
use App\Models\Master\SumberDanaSub;
use Illuminate\Database\Seeder;

class SumberDanaSubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sumberDana = SumberDana::where('nama', 'APBD')->firstOrCreate();
        SumberDanaSub::insert([
            [
                'sumber_dana_id' => $sumberDana->id,
                'nama'           => 'DAK (Dana Alokasi Khusus)',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'sumber_dana_id' => $sumberDana->id,
                'nama'           => 'BANKEU',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'sumber_dana_id' => $sumberDana->id,
                'nama'           => 'BOK',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
