<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kategoriAset extends Model
{
    use HasFactory;

    protected $primaryKey = 'kategori_id';
    protected $fillable = ['nama', 'kode', 'deskripsi'];

    protected $table = 'kategori_aset';

    // Relasi dengan aset (jika nanti ada tabel aset)
    public function asets()
    {
        return $this->hasMany(Aset::class, 'kategori_id', 'kategori_id');
    }

    // Scope untuk filter
    public function scopeFilter(Builder $query, $request)
    {
        // Filter berdasarkan deskripsi
        if ($request->filled('deskripsi_filter')) {
            if ($request->deskripsi_filter == 'ada') {
                $query->whereNotNull('deskripsi')->where('deskripsi', '!=', '');
            } elseif ($request->deskripsi_filter == 'tidak_ada') {
                $query->where(function($q) {
                    $q->whereNull('deskripsi')->orWhere('deskripsi', '');
                });
            }
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('kode', 'like', '%' . $search . '%');
            });
        }

        return $query;
    }
}
