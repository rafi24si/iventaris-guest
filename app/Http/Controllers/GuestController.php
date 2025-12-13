<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = [
            [
                'id' => 1,
                'name' => 'Laptop Dell XPS 13',
                'category' => 'Elektronik',
                'status' => 'available',
                'status_label' => 'Tersedia',
                'status_color' => 'success',
                'location' => 'Kantor Desa',
                'description' => 'Laptop business grade dengan spesifikasi tinggi',
                'purchase_date' => '2023-01-15',
                'image_icon' => 'laptop'
            ],
            [
                'id' => 2,
                'name' => 'Proyektor Epson EB-U05',
                'category' => 'Elektronik',
                'status' => 'inuse',
                'status_label' => 'Digunakan',
                'status_color' => 'warning',
                'location' => 'Ruang Desa 1',
                'description' => 'Proyektor HD untuk presentasi',
                'purchase_date' => '2023-02-20',
                'image_icon' => 'video'
            ],
            [
                'id' => 3,
                'name' => 'Kursi Kantor Ergonomis',
                'category' => 'Furnitur',
                'status' => 'available',
                'status_label' => 'Tersedia',
                'status_color' => 'success',
                'location' => 'Gudang Desa',
                'description' => 'Kursi kantor dengan dukungan ergonomis',
                'purchase_date' => '2023-03-10',
                'image_icon' => 'chair'
            ],
        ];

        // Statistics data
        $stats = [
            'total' => 45,
            'available' => 28,
            'in_use' => 12,
            'maintenance' => 5
        ];

        // Quick actions
        $quickActions = [
            ['name' => 'Tambah Barang Baru', 'url' => '#', 'icon' => 'plus'],
            ['name' => 'Pinjam Barang', 'url' => '#', 'icon' => 'handshake'],
            ['name' => 'Kembalikan Barang', 'url' => '#', 'icon' => 'rotate-left'],
            ['name' => 'Laporkan Kerusakan', 'url' => '#', 'icon' => 'exclamation-triangle'],
            ['name' => 'Cetak Laporan', 'url' => '#', 'icon' => 'print']
        ];

        // Hero section data
        $heroData = [
            'title' => 'Kelola Inventaris & Aset Desa dengan Mudah',
            'description' => 'Sistem manajemen inventaris dan aset yang lengkap untuk mengoptimalkan pengelolaan barang dan peralatan desa.',
            'button_text' => 'Lihat Demo',
            'button_url' => '#'
        ];

        return view('homeGuest', compact(
            'inventories',
            'stats',
            'quickActions',
            'heroData'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
