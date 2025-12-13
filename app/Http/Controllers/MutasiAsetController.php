<?php
namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\MutasiAset;
use Illuminate\Http\Request;

class MutasiAsetController extends Controller
{
    public function index(Request $request)
    {
        $query = MutasiAset::with(['aset.media']);

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('jenis_mutasi', 'like', "%{$search}%")
                    ->orWhereHas('aset', function ($a) use ($search) {
                        $a->where('nama_aset', 'like', "%{$search}%")
                            ->orWhere('kode_aset', 'like', "%{$search}%");
                    });
            });
        }

        // 🎯 FILTER JENIS
        if ($request->filled('jenis_mutasi')) {
            $query->where('jenis_mutasi', $request->jenis_mutasi);
        }

        // 🎯 FILTER TANGGAL
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $mutasi = $query
            ->latest('mutasi_id')
            ->paginate(10)
            ->withQueryString();

        // untuk dropdown filter
        $aset = Aset::orderBy('nama_aset')->get();

        return view('pages.mutasi.index', compact('mutasi', 'aset'));
    }

    public function create()
    {
        $aset = Aset::orderBy('nama_aset')->get();
        return view('pages.mutasi.create', compact('aset'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id'      => 'required|exists:aset,aset_id',
            'tanggal'      => 'required|date',
            'jenis_mutasi' => 'required',
            'keterangan'   => 'nullable|string',
        ]);

        MutasiAset::create([
            'aset_id'      => $request->aset_id,
            'tanggal'      => $request->tanggal,
            'jenis_mutasi' => $request->jenis_mutasi,
            'keterangan'   => $request->keterangan,
        ]);

        return redirect()->route('mutasi.index')
            ->with('success', 'Data mutasi aset berhasil ditambahkan.');
    }

    public function edit(MutasiAset $mutasi)
    {
        $aset = Aset::orderBy('nama_aset')->get();
        return view('pages.mutasi.edit', compact('mutasi', 'aset'));
    }

    public function update(Request $request, MutasiAset $mutasi)
    {
        $request->validate([
            'aset_id'      => 'required|exists:aset,aset_id',
            'tanggal'      => 'required|date',
            'jenis_mutasi' => 'required',
            'keterangan'   => 'nullable|string',
        ]);

        $mutasi->update([
            'aset_id'      => $request->aset_id,
            'tanggal'      => $request->tanggal,
            'jenis_mutasi' => $request->jenis_mutasi,
            'keterangan'   => $request->keterangan,
        ]);

        return redirect()->route('mutasi.index')
            ->with('success', 'Data mutasi berhasil diperbarui.');
    }

    public function show(MutasiAset $mutasi)
    {
        $mutasi->load(['aset.media']);

        return view('pages.mutasi.show', compact('mutasi'));
    }

    public function destroy(MutasiAset $mutasi)
    {
        $mutasi->delete();

        return redirect()->route('mutasi.index')
            ->with('success', 'Data mutasi berhasil dihapus.');
    }
}
