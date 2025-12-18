<?php

namespace Database\Seeders;

use App\Models\LayananPosyandu;
use App\Models\JadwalPosyandu;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LayananPosyanduSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $vitaminList = [
            'Vitamin A',
            'Tablet Tambah Darah',
            'Vitamin C',
            'Suplemen Zat Besi',
            'Vitamin B Kompleks',
            'Vitamin D',
            'Kalsium',
            'Zinc',
            'Tidak Diberikan',
        ];

        $jadwals = JadwalPosyandu::all();
        $wargas  = Warga::all();

        if ($jadwals->isEmpty() || $wargas->isEmpty()) {
            $this->command->warn('Seeder LayananPosyandu dilewati (jadwal atau warga kosong)');
            return;
        }

        foreach ($jadwals as $jadwal) {

            // setiap jadwal melayani 5–15 warga
            $jumlahPeserta = $faker->numberBetween(5, 15);

            $peserta = $wargas->random(
                min($jumlahPeserta, $wargas->count())
            );

            foreach ($peserta as $warga) {

                // cegah duplikasi
                $exists = LayananPosyandu::where('jadwal_id', $jadwal->jadwal_id)
                    ->where('warga_id', $warga->warga_id)
                    ->exists();

                if ($exists) {
                    continue;
                }

                LayananPosyandu::create([
                    'jadwal_id' => $jadwal->jadwal_id,
                    'warga_id'  => $warga->warga_id,

                    // data fisik (balita & ibu)
                    'berat'     => $faker->randomFloat(1, 5.0, 25.0),   // kg
                    'tinggi'    => $faker->randomFloat(1, 50.0, 120.0), // cm

                    'vitamin'   => $faker->randomElement($vitaminList),

                    'konseling' => $faker->boolean(60)
                        ? $faker->sentence(8)
                        : null,
                ]);
            }
        }
    }
}
