<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaderPosyandu extends Model
{
    protected $table = 'kader_posyandus';

    protected $primaryKey = 'kader_id';

    protected $fillable = [
        'posyandu_id',
        'warga_id',
        'peran',
        'mulai_tugas',
        'akhir_tugas',
    ];

    protected $casts = [
        'mulai_tugas' => 'date',
        'akhir_tugas' => 'date',
    ];

    /* ================= RELATIONS ================= */

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'posyandu_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    /* ================= SCOPES ================= */

    // Kader aktif
    public function scopeAktif($query)
    {
        return $query->whereNull('akhir_tugas')
                     ->orWhere('akhir_tugas', '>=', now());
    }
}
