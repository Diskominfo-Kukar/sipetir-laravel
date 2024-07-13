<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listUser = [
            [
                'nama'     => 'Superadmin',
                'username' => 'Superadmin',
                'email'    => 'Superadmin@admin.com',
                'password' => bcrypt('super'),
                'role'     => 'superadmin',
            ],
            [
                'nama'     => 'admin',
                'username' => 'admin',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'role'     => 'admin',
            ],
        ];

        foreach ($listUser as $key => $user) {
            $nama         = $user['nama'];
            $usernameUser = $user['username'];
            $emailUser    = $user['email'];
            $passwordUser = $user['password'];
            $role         = $user['role'];

            $user[$key] = User::firstOrCreate(
                [
                    'nama'     => $nama,
                    'email'    => $emailUser,
                    'username' => $usernameUser,
                    'password' => $passwordUser,
                ]
            );
            $user[$key]->assignRole($role);
        }
    }
}
