<?php

namespace App\Http\Controllers;

use App\Models\CatatanImunisasi;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatatanImunisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = CatatanImunisasi::with(['warga', 'media']);

        if ($request->filled('warga_id')) {
            $query->where('warga_id', $request->warga_id);
        }

        if ($request->filled('search')) {
            $query->where('jenis_vaksin', 'like', "%{$request->search}%");
        }

        return view('catatan_imunisasi.index', [
            'imunisasis' => $query->latest('tanggal')->paginate(6)->withQueryString(),
            'wargas'     => Warga::orderBy('nama')->get(),
        ]);
    }

    public function create()
    {
        return view('catatan_imunisasi.create', [
            'wargas' => Warga::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id'     => 'required|exists:wargas,warga_id',
            'jenis_vaksin' => 'required|string|max:100',
            'tanggal'      => 'required|date',
            'lokasi'       => 'nullable|string|max:150',
            'nakes'        => 'nullable|string|max:150',
            'kartu'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imunisasi = CatatanImunisasi::create([
            'warga_id'     => $request->warga_id,
            'jenis_vaksin' => $request->jenis_vaksin,
            'tanggal'      => $request->tanggal,
            'lokasi'       => $request->lokasi,
            'nakes'        => $request->nakes,
        ]);

        // ✅ UPLOAD KARTU IMUNISASI (FIX)
        if ($request->hasFile('kartu')) {

            $file = $request->file('kartu');
            $path = $file->store('catatan_imunisasi', 'public');

            Media::create([
                'ref_table' => 'catatan_imunisasi',
                'ref_id'    => $imunisasi->imunisasi_id,
                'file_name' => basename($path),
                'mime_type' => $file->getClientMimeType(),
                'caption'   => 'Kartu Imunisasi',
                'sort_order'=> 1,
            ]);
        }

        return redirect()
            ->route('catatan-imunisasi.index')
            ->with('success', 'Catatan imunisasi berhasil ditambahkan');
    }

    public function show(CatatanImunisasi $catatan_imunisasi)
    {
        $catatan_imunisasi->load(['warga', 'media']);

        return view('catatan_imunisasi.show', [
            'imunisasi' => $catatan_imunisasi,
        ]);
    }

    public function edit(CatatanImunisasi $catatan_imunisasi)
    {
        return view('catatan_imunisasi.edit', [
            'imunisasi' => $catatan_imunisasi,
            'wargas'    => Warga::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, CatatanImunisasi $catatan_imunisasi)
    {
        $request->validate([
            'jenis_vaksin' => 'required|string|max:100',
            'tanggal'      => 'required|date',
            'lokasi'       => 'nullable|string|max:150',
            'nakes'        => 'nullable|string|max:150',
            'kartu'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $catatan_imunisasi->update([
            'jenis_vaksin' => $request->jenis_vaksin,
            'tanggal'      => $request->tanggal,
            'lokasi'       => $request->lokasi,
            'nakes'        => $request->nakes,
        ]);

        // ✅ GANTI KARTU
        if ($request->hasFile('kartu')) {

            foreach ($catatan_imunisasi->media as $media) {
                Storage::disk('public')->delete('catatan_imunisasi/'.$media->file_name);
                $media->delete();
            }

            $file = $request->file('kartu');
            $path = $file->store('catatan_imunisasi', 'public');

            Media::create([
                'ref_table' => 'catatan_imunisasi',
                'ref_id'    => $catatan_imunisasi->imunisasi_id,
                'file_name' => basename($path),
                'mime_type' => $file->getClientMimeType(),
                'caption'   => 'Kartu Imunisasi',
                'sort_order'=> 1,
            ]);
        }

        return redirect()
            ->route('catatan-imunisasi.index')
            ->with('success', 'Catatan imunisasi berhasil diperbarui');
    }

    public function destroy(CatatanImunisasi $catatan_imunisasi)
    {
        foreach ($catatan_imunisasi->media as $media) {
            Storage::disk('public')->delete('catatan_imunisasi/'.$media->file_name);
            $media->delete();
        }

        $catatan_imunisasi->delete();

        return redirect()
            ->route('catatan-imunisasi.index')
            ->with('success', 'Catatan imunisasi berhasil dihapus');
    }
}
