<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($o = 0; $o <= 20; $o++){
            DB::table("bukus")->insert([
                'judul' => "Bulan",
                "pengarang" => $faker->name(),
                "cover" => "Belom ada",
                "isbn" => "0845486" ,
                "penerbit" => "John Obami",
                "deskripsi_buku" => "jelek" ,
                "stok_buku" => $faker->randomNumber(),
                "tanggal_terbit" => "2025-12-25",
            ]);
        }
    }
}
