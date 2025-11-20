<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($o = 0; $o <= 20; $o++){
            DB::table("penggunas")->insert([
                "nama" => $faker->name(),
                "email" => $faker->email(),
                "password" => "1234",
                "role" => $faker->randomElement(['admin', 'pengguna', 'petugas'])
            ]);
        }
    }
}
