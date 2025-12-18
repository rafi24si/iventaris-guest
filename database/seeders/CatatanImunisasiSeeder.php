<?php

namespace Database\Seeders;

use App\Models\CatatanImunisasi;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CatatanImunisasiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $jenisVaksin = [
            'BCG',
            'Polio 1',
            'Polio 2',
            'Polio 3',
            'Polio 4',
            'DPT 1',
            'DPT 2',
            'DPT 3',
            'Hepatitis B',
            'Campak',
            'Campak Rubella',
            'Hib',
            'PCV',
            'Rotavirus',
            'COVID-19',
        ];

        $lokasi = [
            'Posyandu',
            'Puskesmas',
        ];

        $wargas = Warga::all();

        if ($wargas->isEmpty()) {
            $this->command->warn('Seeder CatatanImunisasi dilewati (data warga kosong)');
            return;
        }

        foreach ($wargas as $warga) {

            // tiap warga punya 1–5 imunisasi
            $jumlah = $faker->numberBetween(1, 5);

            $vaksinDipakai = $faker->randomElements(
                $jenisVaksin,
                min($jumlah, count($jenisVaksin))
            );

            foreach ($vaksinDipakai as $vaksin) {

                CatatanImunisasi::create([
                    'warga_id'     => $warga->warga_id,
                    'jenis_vaksin' => $vaksin,
                    'tanggal'      => $faker->dateTimeBetween('-5 years', 'now'),
                    'lokasi'       => $faker->randomElement($lokasi),
                    'nakes'        => 'Bidan ' . $faker->firstNameFemale(),
                ]);
            }
        }
    }
}
