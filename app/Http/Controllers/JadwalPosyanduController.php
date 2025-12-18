<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use App\Models\Posyandu;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalPosyanduController extends Controller
{
    public function index(Request $request)
    {
        $query = JadwalPosyandu::with(['posyandu', 'media']);

        // 🔍 Filter Posyandu
        if ($request->filled('posyandu_id')) {
            $query->where('posyandu_id', $request->posyandu_id);
        }

        // 🔍 Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        return view('jadwal_posyandu.index', [
            'jadwals'   => $query->latest('tanggal')->paginate(6)->withQueryString(),
            'posyandus' => Posyandu::orderBy('nama')->get(),
        ]);
    }

    public function create()
    {
        return view('jadwal_posyandu.create', [
            'posyandus' => Posyandu::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandus,posyandu_id',
            'tanggal'     => 'required|date',
            'tema'        => 'required|string|max:150',
            'keterangan'  => 'nullable|string',
            'poster'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $jadwal = JadwalPosyandu::create([
            'posyandu_id' => $request->posyandu_id,
            'tanggal'     => $request->tanggal,
            'tema'        => $request->tema,
            'keterangan'  => $request->keterangan,
        ]);

        // 📸 Simpan poster kegiatan
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $path = $file->store('jadwal_posyandu', 'public');

            Media::create([
                'ref_table' => 'jadwal_posyandu',
                'ref_id'    => $jadwal->jadwal_id,
                'file_name' => basename($path),
                'mime_type' => $file->getClientMimeType(),
                'caption'   => 'Poster Kegiatan Posyandu',
                'sort_order'=> 1,
            ]);
        }

        return redirect()
            ->route('jadwal-posyandu.index')
            ->with('success', 'Jadwal Posyandu berhasil ditambahkan');
    }

    public function show(JadwalPosyandu $jadwal_posyandu)
    {
        $jadwal_posyandu->load(['posyandu', 'media']);

        return view('jadwal_posyandu.show', [
            'jadwal' => $jadwal_posyandu,
        ]);
    }

    public function edit(JadwalPosyandu $jadwal_posyandu)
    {
        return view('jadwal_posyandu.edit', [
            'jadwal'   => $jadwal_posyandu,
            'posyandus'=> Posyandu::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, JadwalPosyandu $jadwal_posyandu)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'tema'       => 'required|string|max:150',
            'keterangan' => 'nullable|string',
            'poster'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $jadwal_posyandu->update([
            'tanggal'    => $request->tanggal,
            'tema'       => $request->tema,
            'keterangan' => $request->keterangan,
        ]);

        // 📸 Ganti poster jika upload baru
        if ($request->hasFile('poster')) {

            // hapus poster lama
            foreach ($jadwal_posyandu->media as $media) {
                Storage::disk('public')->delete('jadwal_posyandu/'.$media->file_name);
                $media->delete();
            }

            $file = $request->file('poster');
            $path = $file->store('jadwal_posyandu', 'public');

            Media::create([
                'ref_table' => 'jadwal_posyandu',
                'ref_id'    => $jadwal_posyandu->jadwal_id,
                'file_name' => basename($path),
                'mime_type' => $file->getClientMimeType(),
                'caption'   => 'Poster Kegiatan Posyandu',
                'sort_order'=> 1,
            ]);
        }

        return redirect()
            ->route('jadwal-posyandu.index')
            ->with('success', 'Jadwal Posyandu berhasil diperbarui');
    }

    public function destroy(JadwalPosyandu $jadwal_posyandu)
    {
        foreach ($jadwal_posyandu->media as $media) {
            Storage::disk('public')->delete('jadwal_posyandu/'.$media->file_name);
            $media->delete();
        }

        $jadwal_posyandu->delete();

        return redirect()
            ->route('jadwal-posyandu.index')
            ->with('success', 'Jadwal Posyandu berhasil dihapus');
    }
}
