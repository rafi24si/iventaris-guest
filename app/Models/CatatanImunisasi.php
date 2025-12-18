<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanImunisasi extends Model
{
    protected $table = 'catatan_imunisasis';
    protected $primaryKey = 'imunisasi_id';

    protected $fillable = [
        'warga_id',
        'jenis_vaksin',
        'tanggal',
        'lokasi',
        'nakes',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function warga()
    {
        return $this->belongsTo(
            Warga::class,
            'warga_id',
            'warga_id'
        );
    }

    // MEDIA (scan kartu imunisasi)
    public function media()
    {
        return $this->hasMany(
            Media::class,
            'ref_id',
            'imunisasi_id'
        )->where('ref_table', 'catatan_imunisasi');
    }
}
