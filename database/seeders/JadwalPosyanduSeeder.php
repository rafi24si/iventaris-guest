<?php

namespace Database\Seeders;

use App\Models\JadwalPosyandu;
use App\Models\Posyandu;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;

class JadwalPosyanduSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $temaKegiatan = [
            'Penimbangan Balita',
            'Imunisasi Rutin',
            'Pemberian Vitamin A',
            'Pemeriksaan Ibu Hamil',
            'Penyuluhan Gizi Seimbang',
            'Pemeriksaan Kesehatan Anak',
            'Kelas Ibu Balita',
            'Konseling Kesehatan',
            'Pemantauan Tumbuh Kembang',
        ];

        $posyandus = Posyandu::all();

        if ($posyandus->isEmpty()) {
            $this->command->warn('Seeder JadwalPosyandu dilewati (data posyandu kosong)');
            return;
        }

        foreach ($posyandus as $posyandu) {

            // setiap posyandu punya 5–10 jadwal
            $jumlahJadwal = $faker->numberBetween(5, 10);

            foreach (range(1, $jumlahJadwal) as $i) {

                $tanggal = Carbon::parse(
                    $faker->dateTimeBetween('-6 months', '+6 months')
                )->startOfDay();

                JadwalPosyandu::create([
                    'posyandu_id' => $posyandu->posyandu_id,
                    'tanggal'     => $tanggal,
                    'tema'        => $faker->randomElement($temaKegiatan),
                    'keterangan'  => $faker->boolean(70)
                        ? $faker->sentence(8)
                        : null,
                ]);
            }
        }
    }
}
