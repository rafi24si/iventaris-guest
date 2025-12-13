<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PemeliharaanAset;
use App\Models\Aset;
use Faker\Factory as Faker;

class PemeliharaanAsetDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Daftar contoh tindakan agar data terlihat real
        $daftarTindakan = [
            'Servis Rutin',
            'Ganti Sparepart',
            'Perbaikan Kerusakan Ringan',
            'Pembersihan Unit',
            'Instalasi Ulang Software',
            'Pengecekan Berkala'
        ];

        // Buat 10 data dummy
        for ($i = 0; $i < 30; $i++) {

            // Ambil acak 1 ID dari tabel Aset
            $aset = Aset::inRandomOrder()->first();

            // Cek jika tabel aset kosong, hentikan agar tidak error
            if (!$aset) { break; }

            PemeliharaanAset::create([
                'aset_id'   => $aset->aset_id,
                // Tanggal acak antara 1 tahun lalu sampai sekarang
                'tanggal'   => $faker->dateTimeBetween('-1 year', 'now'),
                // Pilih tindakan acak dari array di atas
                'tindakan'  => $faker->randomElement($daftarTindakan),
                // Biaya acak antara 50rb sampai 2 juta
                'biaya'     => $faker->numberBetween(50000, 2000000),
                'pelaksana' => $faker->name, // Nama orang atau bisa ganti $faker->company
            ]);
        }
    }
}
