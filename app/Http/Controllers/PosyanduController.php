<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PosyanduController extends Controller
{
    public function index(Request $request)
    {
        $query = Posyandu::with('media');

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('kontak', 'like', "%{$search}%");
            });
        }

        // FILTER RT
        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }

        // FILTER RW
        if ($request->filled('rw')) {
            $query->where('rw', $request->rw);
        }

        return view('pages.posyandu.index', [
            'posyandus' => $query->latest()->paginate(6)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('pages.posyandu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt'     => 'required|string|max:5',
            'rw'     => 'required|string|max:5',
            'kontak' => 'nullable|string|max:50',
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $posyandu = Posyandu::create([
            'nama'   => $request->nama,
            'alamat' => $request->alamat,
            'rt'     => $request->rt,
            'rw'     => $request->rw,
            'kontak' => $request->kontak,
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('posyandu', 'public');

            Media::create([
                'ref_table' => 'posyandu',
                'ref_id'    => $posyandu->posyandu_id,
                'file_name' => $path, // ✅ PATH DISIMPAN DI SINI
                'caption'   => 'Foto Posyandu',
                'mime_type' => $file->getClientMimeType(),
                'sort_order'=> 1,
            ]);
        }

        return redirect()
            ->route('posyandu.index')
            ->with('success', 'Data Posyandu berhasil ditambahkan');
    }

    public function show(Posyandu $posyandu)
    {
        $posyandu->load('media');
        return view('pages.posyandu.show', compact('posyandu'));
    }

    public function edit(Posyandu $posyandu)
    {
        $posyandu->load('media');
        return view('pages.posyandu.edit', compact('posyandu'));
    }

    public function update(Request $request, Posyandu $posyandu)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt'     => 'required|string|max:5',
            'rw'     => 'required|string|max:5',
            'kontak' => 'nullable|string|max:50',
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $posyandu->update([
            'nama'   => $request->nama,
            'alamat' => $request->alamat,
            'rt'     => $request->rt,
            'rw'     => $request->rw,
            'kontak' => $request->kontak,
        ]);

        if ($request->hasFile('foto')) {

            $oldMedia = $posyandu->media()->first();
            if ($oldMedia) {
                Storage::disk('public')->delete($oldMedia->file_name); // ✅ FIX
                $oldMedia->delete();
            }

            $file = $request->file('foto');
            $path = $file->store('posyandu', 'public');

            Media::create([
                'ref_table' => 'posyandu',
                'ref_id'    => $posyandu->posyandu_id,
                'file_name' => $path, // ✅ FIX
                'caption'   => 'Foto Posyandu',
                'mime_type' => $file->getClientMimeType(),
                'sort_order'=> 1,
            ]);
        }

        return redirect()
            ->route('posyandu.index')
            ->with('success', 'Data Posyandu berhasil diperbarui');
    }

    public function destroy(Posyandu $posyandu)
    {
        foreach ($posyandu->media as $media) {
            Storage::disk('public')->delete($media->file_name); // ✅ FIX
            $media->delete();
        }

        $posyandu->delete();

        return redirect()
            ->route('posyandu.index')
            ->with('success', 'Data Posyandu berhasil dihapus');
    }
}
