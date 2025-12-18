<?php

namespace Database\Seeders;

use App\Models\Posyandu;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PosyanduSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $namaPosyandu = [
            'Melati', 'Mawar', 'Anggrek', 'Kenanga', 'Cempaka',
            'Teratai', 'Bougenville', 'Flamboyan', 'Kamboja', 'Dahlia'
        ];

        foreach (range(1, 20) as $i) {
            Posyandu::create([
                'nama'   => 'Posyandu ' . $faker->randomElement($namaPosyandu) . ' ' . $faker->numberBetween(1, 50),
                'alamat' => $faker->streetAddress . ', ' . $faker->city,
                'rt'     => str_pad($faker->numberBetween(1, 20), 2, '0', STR_PAD_LEFT),
                'rw'     => str_pad($faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
                'kontak' => $faker->phoneNumber,
            ]);
        }
    }
}
