<?php
namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\LokasiAset;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LokasiAsetController extends Controller
{
    public function index(Request $request)
    {
        $query = LokasiAset::with(['aset', 'media']);

        // 🔍 SEARCH (nama aset / lokasi)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('lokasi_text', 'like', "%$search%")
                    ->orWhereHas('aset', function ($a) use ($search) {
                        $a->where('nama_aset', 'like', "%$search%")
                            ->orWhere('kode_aset', 'like', "%$search%");
                    });
            });
        }

        $lokasiAset = $query
            ->latest('lokasi_id')
            ->paginate(10)
            ->withQueryString();

        return view('pages.lokasi-aset.index', compact('lokasiAset'));
    }

    public function create()
    {
        $aset = Aset::all();
        return view('pages.lokasi-aset.create', compact('aset'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id'     => 'required|exists:aset,aset_id',
            'lokasi_text' => 'required|string|max:255',
            'rt'          => 'required|numeric',
            'rw'          => 'required|numeric',
            'keterangan'  => 'nullable|string',
            'media_file'  => 'nullable|image|max:4096',
        ]);

        // SIMPAN LOKASI
        $lokasiAset = LokasiAset::create([
            'aset_id'     => $request->aset_id,
            'lokasi_text' => $request->lokasi_text,
            'rt'          => $request->rt,
            'rw'          => $request->rw,
            'keterangan'  => $request->keterangan,
        ]);

        // SIMPAN FOTO (JIKA ADA)
        if ($request->hasFile('media_file')) {
            $path = $request->file('media_file')->store('lokasi_aset', 'public');

            Media::create([
                'ref_table'  => 'lokasi_aset',
                'ref_id'     => $lokasiAset->lokasi_id,
                'file_name'  => $path,
                'caption'    => 'Foto Lokasi',
                'mime_type'  => $request->file('media_file')->getClientMimeType(),
                'sort_order' => 1,
            ]);
        }

        return redirect()->route('lokasi-aset.index')
            ->with('success', 'Lokasi aset berhasil ditambahkan!');
    }

    // ✅ SHOW (DETAIL LOKASI ASET)
    public function show($id)
    {
        $lokasiAset = LokasiAset::with(['aset', 'media'])->findOrFail($id);

        return view('pages.lokasi-aset.show', compact('lokasiAset'));
    }

    public function edit(LokasiAset $lokasiAset)
    {
        $aset = Aset::all();
        return view('pages.lokasi-aset.edit', compact('lokasiAset', 'aset'));
    }

    public function update(Request $request, LokasiAset $lokasiAset)
    {
        $request->validate([
            'aset_id'     => 'required|exists:aset,aset_id',
            'lokasi_text' => 'required|string|max:255',
            'rt'          => 'required|numeric',
            'rw'          => 'required|numeric',
            'keterangan'  => 'nullable|string',
            'media_file'  => 'nullable|image|max:4096',
        ]);

        $lokasiAset->update([
            'aset_id'     => $request->aset_id,
            'lokasi_text' => $request->lokasi_text,
            'rt'          => $request->rt,
            'rw'          => $request->rw,
            'keterangan'  => $request->keterangan,
        ]);

        if ($request->hasFile('media_file')) {

            $oldMedia = Media::where('ref_table', 'lokasi_aset')
                ->where('ref_id', $lokasiAset->lokasi_id)
                ->first();

            if ($oldMedia && Storage::disk('public')->exists($oldMedia->file_name)) {
                Storage::disk('public')->delete($oldMedia->file_name);
            }

            $path = $request->file('media_file')->store('lokasi_aset', 'public');

            Media::updateOrCreate(
                [
                    'ref_table' => 'lokasi_aset',
                    'ref_id'    => $lokasiAset->lokasi_id,
                ],
                [
                    'file_name'  => $path,
                    'caption'    => 'Foto Lokasi',
                    'mime_type'  => $request->file('media_file')->getClientMimeType(),
                    'sort_order' => 1,
                ]
            );
        }

        return redirect()->route('lokasi-aset.index')
            ->with('success', 'Lokasi aset berhasil diperbarui!');
    }

    public function destroy(LokasiAset $lokasiAset)
    {
        $medias = Media::where('ref_table', 'lokasi_aset')
            ->where('ref_id', $lokasiAset->lokasi_id)
            ->get();

        foreach ($medias as $media) {
            if (Storage::disk('public')->exists($media->file_name)) {
                Storage::disk('public')->delete($media->file_name);
            }
            $media->delete();
        }

        $lokasiAset->delete();

        return redirect()->route('lokasi-aset.index')
            ->with('success', 'Lokasi aset berhasil dihapus!');
    }
}
