<?php

namespace Database\Seeders;

use App\Models\Aset;
use App\Models\kategoriAset;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AsetDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $kategories = kategoriAset::all();

        for ($i = 1; $i <= 100; $i++) {
            $kategori = $faker->randomElement($kategories);

            Aset::create([
                'kode_aset' => 'AST' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'nama_aset' => $kategori->nama . ' ' . $faker->word() . ' ' . $faker->randomElement(['A', 'B', 'C', 'X', 'Z']),
                'kategori_id' => $kategori->kategori_id,
                'tgl_perolehan' => $faker->dateTimeBetween('-3 years', 'now'),
                'nilai_perolehan' => $faker->numberBetween(1000000, 100000000),
                'kondisi' => $faker->randomElement(['Baik', 'Rusak Ringan', 'Rusak Berat']),
            ]);
        }
    }
}
