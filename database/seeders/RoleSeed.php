<?php

namespace Database\Seeders;

use App\Models\Master\Jabatan;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'superadmin',
            'Admin',
            'Panitia',
            'PPK',
            'Kepala BPBJ',
        ];

        foreach ($roles as $value) {
            $role = Role::create([
                'name' => $value,
            ]);

            if (
                $value != 'superadmin' &&
                $value != 'PPK'
            ) {
                Jabatan::updateOrCreate(
                    // ['role_id' => $role->id],
                    ['nama' => ucfirst($value)]
                );
            }
        }
    }
}
