<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananPosyandu extends Model
{
    protected $primaryKey = 'layanan_id';

    protected $fillable = [
        'jadwal_id',
        'warga_id',
        'berat',
        'tinggi',
        'vitamin',
        'konseling',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function jadwal()
    {
        return $this->belongsTo(
            JadwalPosyandu::class,
            'jadwal_id',
            'jadwal_id'
        );
    }

    public function warga()
    {
        return $this->belongsTo(
            Warga::class,
            'warga_id',
            'warga_id'
        );
    }
}
