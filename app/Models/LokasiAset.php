<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiAset extends Model
{
    protected $table = 'lokasi_aset';
    protected $primaryKey = 'lokasi_id';

    protected $fillable = [
        'aset_id',
        'lokasi_text',
        'rt',
        'rw',
        'keterangan',
    ];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'aset_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'lokasi_id')
            ->where('ref_table', 'lokasi_aset');
    }
}
