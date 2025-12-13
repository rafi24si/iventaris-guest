<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\Warga;
use Illuminate\Database\Seeder;

class WargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $jenisKelamin = ['Laki-laki', 'Perempuan'];

        $pekerjaan = [
            'Wiraswasta', 'Pegawai Negeri', 'Karyawan Swasta', 'Petani', 'Nelayan',
            'Guru', 'Dokter', 'Perawat', 'Pedagang', 'Sopir', 'Buruh', 'Pensiunan',
            'Ibu Rumah Tangga', 'Pelajar/Mahasiswa', 'Pengusaha', 'PNS', 'TNI', 'Polri',
            'Pilot', 'Pramugari', 'Arsitek', 'Akuntan', 'Programmer', 'Desainer',
            'Koki', 'Bartender', 'Satpam', 'Tukang Kayu', 'Tukang Batu', 'Montir'
        ];

        for ($i = 0; $i < 100; $i++) {
            $jenisKelaminRandom = $faker->randomElement($jenisKelamin);
            $nama = $jenisKelaminRandom === 'Laki-laki'
                ? $faker->firstNameMale() . ' ' . $faker->lastName()
                : $faker->firstNameFemale() . ' ' . $faker->lastName();

            Warga::create([
                'no_ktp' => $faker->unique()->numerify('32##############'), // 16 karakter
                'nama' => $nama,
                'jenis_kelamin' => $jenisKelaminRandom,
                'agama' => $faker->randomElement($agama),
                'pekerjaan' => $faker->randomElement($pekerjaan),
                'telp' => $faker->optional(0.8)->numerify('08###########'), // maksimal 13 karakter (08 + 11 digit)
                'email' => $faker->optional(0.7)->safeEmail(),
            ]);
        }
    }
}
