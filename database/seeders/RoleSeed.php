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
            'ppk',
            'Kepala BPBJ',
        ];

        foreach ($roles as $value) {
            $role = Role::create([
                'name' => $value,
            ]);

            if (
                $value != 'superadmin' &&
                $value != 'PKK'
            ) {
                Jabatan::updateOrCreate(
                    ['role_id' => $role->id],
                    ['nama' => $value]
                );
            }
        }
    }
}
