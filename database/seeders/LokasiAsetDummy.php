<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LokasiAset;
use App\Models\Aset;
use Faker\Factory as Faker;

class LokasiAsetDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Buat 100 data dummy saja
        for ($i = 0; $i < 100; $i++) {

            // Ambil 1 ID Aset secara acak (Pastikan tabel 'aset' sudah ada isinya!)
            $aset = Aset::inRandomOrder()->first();

            // Jika tidak ada aset, hentikan loop agar tidak error
            if (!$aset) { break; }

            LokasiAset::create([
                'aset_id'     => $aset->aset_id,
                'lokasi_text' => $faker->address,
                'rt'          => $faker->numberBetween(1, 20),
                'rw'          => $faker->numberBetween(1, 10),
                'keterangan'  => 'Data dummy lokasi',
            ]);
        }
    }
}
