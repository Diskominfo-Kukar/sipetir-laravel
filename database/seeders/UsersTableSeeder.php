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
                'name'     => 'Superadmin',
                'username' => 'Superadmin',
                'email'    => 'Superadmin@admin.com',
                'password' => bcrypt('super'),
                'role'     => 'superadmin',
            ],
            [
                'name'     => 'admin',
                'username' => 'admin',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'role'     => 'admin',
            ],
        ];

        foreach ($listUser as $key => $user) {
            $namaUser     = $user['name'];
            $usernameUser = $user['username'];
            $emailUser    = $user['email'];
            $passwordUser = $user['password'];
            $role         = $user['role'];

            $user[$key] = User::firstOrCreate(
                [
                    'name'     => $namaUser,
                    'email'    => $emailUser,
                    'username' => $usernameUser,
                    'password' => $passwordUser,
                ]
            );
            $user[$key]->assignRole($role);
        }
    }
}
