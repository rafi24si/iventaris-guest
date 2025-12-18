<?php

namespace Database\Seeders;

use App\Models\KaderPosyandu;
use App\Models\Posyandu;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;

class KaderPosyanduSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $peranKader = [
            'Ketua Kader',
            'Sekretaris',
            'Bendahara',
            'Kader Timbang',
            'Kader Imunisasi',
            'Kader Gizi',
            'Kader Kesehatan Ibu',
            'Kader Kesehatan Anak',
        ];

        $posyandus = Posyandu::all();
        $wargas    = Warga::all();

        if ($posyandus->isEmpty() || $wargas->isEmpty()) {
            $this->command->warn('Seeder KaderPosyandu dilewati (data posyandu / warga kosong)');
            return;
        }

        foreach ($posyandus as $posyandu) {

            // setiap posyandu punya 3–6 kader
            $jumlahKader = $faker->numberBetween(3, 6);

            $wargaDipakai = $wargas->random(min($jumlahKader, $wargas->count()));

            foreach ($wargaDipakai as $warga) {

                // cek agar tidak dobel (sesuai unique index)
                $exists = KaderPosyandu::where('posyandu_id', $posyandu->posyandu_id)
                    ->where('warga_id', $warga->warga_id)
                    ->exists();

                if ($exists) {
                    continue;
                }

                // tanggal mulai tugas
                $mulai = Carbon::parse(
                    $faker->dateTimeBetween('-3 years', '-6 months')
                );

                // 70% masih aktif, 30% sudah selesai
                $aktif = $faker->boolean(70);

                KaderPosyandu::create([
                    'posyandu_id' => $posyandu->posyandu_id,
                    'warga_id'    => $warga->warga_id,
                    'peran'       => $faker->randomElement($peranKader),
                    'mulai_tugas' => $mulai,
                    'akhir_tugas' => $aktif
                        ? null
                        : $mulai->copy()->addMonths($faker->numberBetween(6, 24)),
                ]);
            }
        }
    }
}
