<?php

namespace App\Http\Controllers;

use App\Models\KaderPosyandu;
use App\Models\Posyandu;
use App\Models\Warga;
use Illuminate\Http\Request;

class KaderPosyanduController extends Controller
{
    public function index(Request $request)
    {
        $query = KaderPosyandu::with(['posyandu', 'warga']);

        // Filter Posyandu
        if ($request->filled('posyandu_id')) {
            $query->where('posyandu_id', $request->posyandu_id);
        }

        // Filter status kader
        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->aktif();
            } elseif ($request->status === 'nonaktif') {
                $query->whereNotNull('akhir_tugas')
                      ->where('akhir_tugas', '<', now());
            }
        }

        return view('kader_posyandu.index', [
            'kaders'    => $query->latest()->paginate(6)->withQueryString(),
            'posyandus' => Posyandu::orderBy('nama')->get(),
        ]);
    }

    public function create()
    {
        return view('kader_posyandu.create', [
            'posyandus' => Posyandu::orderBy('nama')->get(),
            'wargas'    => Warga::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandus,posyandu_id',
            'warga_id'    => 'required|exists:warga,warga_id', // ✅ FIX
            'peran'       => 'required|string|max:100',
            'mulai_tugas' => 'required|date',
        ]);

        KaderPosyandu::create([
            'posyandu_id' => $request->posyandu_id,
            'warga_id'    => $request->warga_id,
            'peran'       => $request->peran,
            'mulai_tugas' => $request->mulai_tugas,
        ]);

        return redirect()
            ->route('kader-posyandu.index')
            ->with('success', 'Kader Posyandu berhasil ditambahkan');
    }

    public function show(KaderPosyandu $kader_posyandu)
    {
        $kader_posyandu->load(['warga', 'posyandu']);

        return view('kader_posyandu.show', [
            'kader' => $kader_posyandu,
        ]);
    }

    public function edit(KaderPosyandu $kader_posyandu)
    {
        $kader_posyandu->load(['warga', 'posyandu']);

        return view('kader_posyandu.edit', [
            'kader' => $kader_posyandu,
        ]);
    }

    public function update(Request $request, KaderPosyandu $kader_posyandu)
    {
        $request->validate([
            'peran'       => 'required|string|max:100',
            'mulai_tugas' => 'required|date',
            'akhir_tugas' => 'nullable|date|after_or_equal:mulai_tugas',
        ]);

        $kader_posyandu->update([
            'peran'       => $request->peran,
            'mulai_tugas' => $request->mulai_tugas,
            'akhir_tugas' => $request->akhir_tugas,
        ]);

        return redirect()
            ->route('kader-posyandu.index')
            ->with('success', 'Data kader berhasil diperbarui');
    }

    public function destroy(KaderPosyandu $kader_posyandu)
    {
        $kader_posyandu->delete();

        return redirect()
            ->route('kader-posyandu.index')
            ->with('success', 'Kader Posyandu berhasil dihapus');
    }
}
