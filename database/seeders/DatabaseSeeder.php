<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeed::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DataOpdSeedeer::class);
        $this->call(DataKategoriSeedeer::class);
        $this->call(JenisDokumenSeeder::class);
        $this->call(SumberDanaSubSeeder::class);

        // Artisan::call('sipetir:sync');
    }
}
