<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ModulosSeeder::class);
        $this->call(NiveisSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(UsersVinculosSeeder::class);
        $this->call(AtivosExternosStatusSeeder::class);
        $this->call(AtivosFerramentalStatusSeeder::class);
    }
}
