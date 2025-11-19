<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("bukus")->insert([
            'judul' => "mariojoe",
            "pengarang" => "Ibrahim",
            "penerbit" => "John",
            "cover" => "eg",
            "tanggal_terbit" => ""
        ]);
    }
}
