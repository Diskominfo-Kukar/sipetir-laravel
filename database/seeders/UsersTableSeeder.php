<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin           = new User();
        $superAdmin->name     = 'Superadmin';
        $superAdmin->email    = 'vian.ourtiyo@gmail.com';
        $superAdmin->username = 'super';
        $superAdmin->password = Hash::make('super');
        $superAdmin->save();
        $superAdmin->assignRole('superadmin');

        $admin           = new User();
        $admin->name     = 'Administrator';
        $admin->email    = 'ourtiyo@gmail.com';
        $admin->username = 'admin';
        $admin->password = Hash::make('admin');
        $admin->save();
        $admin->assignRole('admin');
    }
}
