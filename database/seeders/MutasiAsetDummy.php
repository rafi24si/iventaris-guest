<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MutasiAset;
use App\Models\Aset;
use Faker\Factory as Faker;

class MutasiAsetDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Daftar pilihan sesuai dengan ENUM di migration
        $jenisMutasi = [
            'Pemindahan',
            'Penghapusan',
            'Perubahan Status',
            'Peminjaman',
            'Pengembalian'
        ];

        // Buat 10 data dummy
        for ($i = 0; $i < 50; $i++) {

            // Ambil 1 aset secara acak
            $aset = Aset::inRandomOrder()->first();

            // Jika tabel aset kosong, stop loop
            if (!$aset) { break; }

            MutasiAset::create([
                'aset_id'      => $aset->aset_id,
                'tanggal'      => $faker->dateTimeBetween('-1 year', 'now'),
                // Pilih acak dari array jenisMutasi di atas
                'jenis_mutasi' => $faker->randomElement($jenisMutasi),
                'keterangan'   => $faker->sentence(6), // Kalimat acak 6 kata
            ]);
        }
    }
}
