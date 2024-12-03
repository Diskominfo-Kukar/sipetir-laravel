<?php

namespace Database\Seeders;

use App\Models\Master\SumberDanaSub;
use Illuminate\Database\Seeder;

class SumberDanaSubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SumberDanaSub::insert([
            [
                'sumber_dana_id' => 'bf7aaf6f-1f8c-40b8-b22d-e1ce42670f0d',
                'nama'           => 'DAK (Dana Alokasi Khusus)',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'sumber_dana_id' => 'bf7aaf6f-1f8c-40b8-b22d-e1ce42670f0d',
                'nama'           => 'BANKEU',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'sumber_dana_id' => 'bf7aaf6f-1f8c-40b8-b22d-e1ce42670f0d',
                'nama'           => 'BOK',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
