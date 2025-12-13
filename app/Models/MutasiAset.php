<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutasiAset extends Model
{
    protected $table = 'mutasi_aset';
    protected $primaryKey = 'mutasi_id';

    protected $fillable = [
        'aset_id',
        'tanggal',
        'jenis_mutasi',
        'keterangan',
    ];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'aset_id');
    }
}
