<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 50) as $index) {
            DB::table('servicos')->insert([
                'name'      => $faker->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
