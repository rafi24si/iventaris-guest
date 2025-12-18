<?php

namespace App\Http\Controllers;

use App\Models\LayananPosyandu;
use App\Models\JadwalPosyandu;
use App\Models\Warga;
use Illuminate\Http\Request;

class LayananPosyanduController extends Controller
{
    public function index(Request $request)
    {
        $query = LayananPosyandu::with(['jadwal.posyandu', 'warga']);

        // 🔍 filter jadwal
        if ($request->filled('jadwal_id')) {
            $query->where('jadwal_id', $request->jadwal_id);
        }

        // 🔍 search warga
        if ($request->filled('search')) {
            $query->whereHas('warga', function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->search}%")
                  ->orWhere('no_ktp', 'like', "%{$request->search}%");
            });
        }

        return view('layanan_posyandu.index', [
            'layanans' => $query->latest()->paginate(10)->withQueryString(),
            'jadwals'  => JadwalPosyandu::with('posyandu')->orderBy('tanggal')->get(),
        ]);
    }

    public function create()
    {
        return view('layanan_posyandu.create', [
            'jadwals' => JadwalPosyandu::with('posyandu')->orderBy('tanggal')->get(),
            'warga'  => Warga::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwal_posyandus,jadwal_id',
            'warga_id'  => 'required|exists:warga,warga_id',
            'berat'     => 'nullable|numeric|min:0|max:200',
            'tinggi'    => 'nullable|numeric|min:0|max:250',
            'vitamin'   => 'nullable|string|max:100',
            'konseling' => 'nullable|string',
        ]);

        LayananPosyandu::create($request->all());

        return redirect()
            ->route('layanan-posyandu.index')
            ->with('success', 'Data layanan Posyandu berhasil disimpan');
    }

    public function show(LayananPosyandu $layanan_posyandu)
    {
        $layanan_posyandu->load(['jadwal.posyandu', 'warga']);

        return view('layanan_posyandu.show', [
            'layanan' => $layanan_posyandu
        ]);
    }

    public function edit(LayananPosyandu $layanan_posyandu)
    {
        return view('layanan_posyandu.edit', [
            'layanan' => $layanan_posyandu,
            'jadwals' => JadwalPosyandu::with('posyandu')->orderBy('tanggal')->get(),
            'wargas'  => Warga::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, LayananPosyandu $layanan_posyandu)
    {
        $request->validate([
            'berat'     => 'nullable|numeric|min:0|max:200',
            'tinggi'    => 'nullable|numeric|min:0|max:250',
            'vitamin'   => 'nullable|string|max:100',
            'konseling' => 'nullable|string',
        ]);

        $layanan_posyandu->update($request->all());

        return redirect()
            ->route('layanan-posyandu.index')
            ->with('success', 'Data layanan Posyandu berhasil diperbarui');
    }

    public function destroy(LayananPosyandu $layanan_posyandu)
    {
        $layanan_posyandu->delete();

        return redirect()
            ->route('layanan-posyandu.index')
            ->with('success', 'Data layanan Posyandu berhasil dihapus');
    }
}
