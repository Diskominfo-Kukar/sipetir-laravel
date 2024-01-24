<?php

namespace Database\Seeders;

use App\Models\Master\Jabatan;
use Illuminate\Database\Seeder;

class DataJabatanSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $namas = [
            'Admin',
            'Panitia',
            'PKK',
            'Kepala BPBJ',
        ];

        foreach ($namas as $nama) {
            Jabatan::create([
                'nama' => $nama,
            ]);
        }
    }
}
