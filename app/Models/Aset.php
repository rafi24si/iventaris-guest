<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $table = 'aset';

    /** PRIMARY KEY SESUAI MIGRATION */
    protected $primaryKey = 'aset_id';
    public $incrementing  = true;
    protected $keyType    = 'int';

    protected $fillable = [
        'kode_aset',
        'nama_aset',
        'kategori_id',
        'tgl_perolehan', // ← WAJIB ADA!
        'nilai_perolehan',
        'kondisi',
    ];

    protected $casts = [
        'tgl_perolehan' => 'date',
        'nilai_perolehan'   => 'decimal:2',
    ];

    /** RELASI KE KATEGORI */
    public function kategoriAset()
    {
        return $this->belongsTo(KategoriAset::class, 'kategori_id', 'kategori_id');
    }

    /** FILTER SEARCH */
    public function scopeFilter($query, $request)
    {
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_aset', 'like', "%$search%")
                    ->orWhere('nama_aset', 'like', "%$search%");
            });
        }

        return $query;
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'aset_id')
            ->where('ref_table', 'aset')
            ->orderBy('sort_order');
    }
}
