<?php

namespace Database\Seeders;

use App\Models\kategoriAset;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KategoriAsetDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Data kategori utama
        $kategoriUtama = [
            ['Elektronik', 'ELK'],
            ['Furniture', 'FRN'],
            ['Kendaraan', 'KDN'],
            ['Peralatan Kantor', 'PTK'],
            ['Komputer & IT', 'KMP'],
            ['Alat Berat', 'ALT'],
            ['Gedung & Bangunan', 'GDB'],
            ['Peralatan Medis', 'MED'],
            ['Peralatan Listrik', 'PLK'],
            ['Alat Kebersihan', 'AKB'],
            ['Peralatan Dapur', 'PDK'],
            ['Alat Olahraga', 'AOR'],
            ['Peralatan Audio', 'AUD'],
            ['Alat Laboratorium', 'LAB'],
            ['Peralatan Workshop', 'WSH'],
            ['Alat Konstruksi', 'AKS'],
            ['Peralatan Garden', 'GRD'],
            ['Alat Keselamatan', 'KSM'],
            ['Peralatan Marine', 'MRN'],
            ['Alat Pertanian', 'PTN']
        ];

        // Insert kategori utama
        foreach ($kategoriUtama as $data) {
            kategoriAset::create([
                'nama' => $data[0],
                'kode' => $data[1],
                'deskripsi' => $faker->sentence(8)
            ]);
        }

        // Generate 80 data tambahan
        for ($i = 0; $i < 80; $i++) {
            $jenis = $faker->randomElement(['Peralatan', 'Alat', 'Mesin', 'Perangkat', 'Sistem']);
            $spesifikasi = $faker->randomElement([
                'Digital', 'Elektrik', 'Mekanik', 'Manual', 'Otomatis', 'Portable',
                'Stationary', 'Heavy Duty', 'Precision', 'Industrial', 'Commercial',
                'Medical', 'Laboratory', 'Audio', 'Visual', 'Network', 'Security',
                'Safety', 'Monitoring', 'Control', 'Measurement', 'Testing'
            ]);
            $kategori = $faker->randomElement([
                'Kantor', 'Industri', 'Medis', 'Laboratorium', 'Olahraga', 'Musik',
                'Fotografi', 'Video', 'Audio', 'Listrik', 'Mekanik', 'Konstruksi',
                'Pertanian', 'Marine', 'Aviation', 'Automotive', 'Telekomunikasi',
                'IT', 'Network', 'Security', 'Safety', 'Kesehatan', 'Kebersihan',
                'Dapur', 'Restoran', 'Hotel', 'Education', 'Research', 'Development'
            ]);

            $nama = $jenis . ' ' . $spesifikasi . ' ' . $kategori;
            $kode = $this->generateKode($nama, $i + 21);

            kategoriAset::create([
                'nama' => $nama,
                'kode' => $kode,
                'deskripsi' => $faker->sentence(10)
            ]);
        }
    }

    /**
     * Generate kode unik
     */
    private function generateKode($nama, $index)
    {
        $words = explode(' ', $nama);
        $kode = '';

        if (count($words) >= 2) {
            $kode = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1) . substr($words[2] ?? $words[1], 0, 1));
        } else {
            $kode = strtoupper(substr($nama, 0, 3));
        }

        // Tambahkan angka untuk memastikan unik
        return $kode . str_pad($index, 3, '0', STR_PAD_LEFT);
    }
}
