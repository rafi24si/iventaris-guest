<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // menggunakan lokal Indonesia

        for ($i = 0; $i < 100; $i++) {
            $nama = $faker->name();

            User::create([
                'name' => $nama,
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('user123'),
                'email_verified_at' => $faker->optional(0.6)->dateTimeBetween('-6 months', 'now'),
            ]);
        }
    }
}
