<?php
// app/Http/Controllers/KategoriAsetController.php

namespace App\Http\Controllers;

use App\Models\kategoriAset;
use Illuminate\Http\Request;

class KategoriAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategoriAset = KategoriAset::query()

        // 🔍 SEARCH (nama & kode)
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($sub) use ($search) {
                    $sub->where('nama', 'like', "%{$search}%")
                        ->orWhere('kode', 'like', "%{$search}%");
                });
            })

            ->orderBy('nama')
            ->paginate(5)
            ->withQueryString(); // ⬅️ penting biar pagination bawa search

        return view('pages.kategoriAset.index', compact('kategoriAset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kategoriAset.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'kode'      => 'required|string|max:50|unique:kategori_aset',
            'deskripsi' => 'nullable|string',
        ]);

        kategoriAset::create($request->all());

        return redirect()->route('kategoriAset.index')
            ->with('success', 'Kategori aset berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(kategoriAset $kategoriAset)
    {
        return view('pages.kategoriAset.show', compact('kategoriAset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategoriAset $kategoriAset)
    {
        return view('pages.kategoriAset.edit', compact('kategoriAset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategoriAset $kategoriAset)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'kode'      => 'required|string|max:50|unique:kategori_aset,kode,' . $kategoriAset->kategori_id . ',kategori_id',
            'deskripsi' => 'nullable|string',
        ]);

        $kategoriAset->update($request->all());

        return redirect()->route('kategoriAset.index')
            ->with('success', 'Kategori aset berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriAset $kategoriAset)
    {
        $kategoriAset->delete();

        return redirect()->route('kategoriAset.index')
            ->with('success', 'Kategori aset berhasil dihapus!');
    }
}
