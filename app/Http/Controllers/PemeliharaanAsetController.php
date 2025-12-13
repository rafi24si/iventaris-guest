<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Media;
use App\Models\PemeliharaanAset;
use Illuminate\Http\Request;

class PemeliharaanAsetController extends Controller
{
    public function index(Request $request)
    {
        $query = PemeliharaanAset::with(['aset', 'media']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tindakan', 'like', "%{$search}%")
                    ->orWhereHas('aset', function ($a) use ($search) {
                        $a->where('nama_aset', 'like', "%{$search}%")
                          ->orWhere('kode_aset', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('aset_id')) {
            $query->where('aset_id', $request->aset_id);
        }

        $pemeliharaan = $query
            ->latest('pemeliharaan_id')
            ->paginate(10)
            ->withQueryString();

        $aset = Aset::all();

        return view('pages.pemeliharaan.index', compact('pemeliharaan', 'aset'));
    }

    public function create()
    {
        $aset = Aset::all();
        return view('pages.pemeliharaan.create', compact('aset'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id'    => 'required|exists:aset,aset_id',
            'tanggal'    => 'required|date',
            'tindakan'   => 'required|string|max:255',
            'biaya'      => 'required|numeric',
            'pelaksana'  => 'nullable|string|max:255',
            'media_file' => 'nullable|image|max:2048',
        ]);

        $pem = PemeliharaanAset::create([
            'aset_id'   => $request->aset_id,
            'tanggal'   => $request->tanggal,
            'tindakan'  => $request->tindakan,
            'biaya'     => $request->biaya,
            'pelaksana' => $request->pelaksana,
        ]);

        if ($request->hasFile('media_file')) {
            $path = $request->file('media_file')->store('pemeliharaan', 'public');

            Media::create([
                'ref_table'  => 'pemeliharaan_aset',
                'ref_id'     => $pem->pemeliharaan_id,
                'file_name'  => $path,
                'caption'    => 'Bukti Pemeliharaan',
                'mime_type'  => $request->file('media_file')->getMimeType(),
                'sort_order' => 1,
            ]);
        }

        return redirect()->route('pemeliharaan.index')
            ->with('success', 'Pemeliharaan aset berhasil dicatat!');
    }

    // ✅ INI YANG TADI ERROR — SEKARANG FIX
    public function show(PemeliharaanAset $pemeliharaan)
    {
        $pemeliharaan->load(['aset', 'media']);
        return view('pages.pemeliharaan.show', compact('pemeliharaan'));
    }

    public function edit(PemeliharaanAset $pemeliharaan)
    {
        $aset = Aset::all();
        return view('pages.pemeliharaan.edit', compact('pemeliharaan', 'aset'));
    }

    public function update(Request $request, PemeliharaanAset $pemeliharaan)
    {
        $request->validate([
            'aset_id'    => 'required|exists:aset,aset_id',
            'tanggal'    => 'required|date',
            'tindakan'   => 'required|string|max:255',
            'biaya'      => 'required|numeric',
            'pelaksana'  => 'nullable|string|max:255',
            'media_file' => 'nullable|image|max:2048',
        ]);

        $pemeliharaan->update($request->only([
            'aset_id','tanggal','tindakan','biaya','pelaksana'
        ]));

        if ($request->hasFile('media_file')) {
            $path = $request->file('media_file')->store('pemeliharaan', 'public');

            Media::updateOrCreate(
                [
                    'ref_table' => 'pemeliharaan_aset',
                    'ref_id'    => $pemeliharaan->pemeliharaan_id,
                ],
                [
                    'file_name' => $path,
                    'caption'   => 'Bukti Pemeliharaan',
                    'mime_type' => $request->file('media_file')->getMimeType(),
                    'sort_order'=> 1,
                ]
            );
        }

        return redirect()->route('pemeliharaan.index')
            ->with('success', 'Data pemeliharaan berhasil diperbarui!');
    }

    public function destroy(PemeliharaanAset $pemeliharaan)
    {
        Media::where('ref_table','pemeliharaan_aset')
            ->where('ref_id',$pemeliharaan->pemeliharaan_id)
            ->delete();

        $pemeliharaan->delete();

        return redirect()->route('pemeliharaan.index')
            ->with('success','Data pemeliharaan berhasil dihapus!');
    }
}
