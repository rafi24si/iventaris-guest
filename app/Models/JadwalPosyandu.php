<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    protected $primaryKey = 'jadwal_id';

    protected $fillable = [
        'posyandu_id',
        'tanggal',
        'tema',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'posyandu_id');
    }

    // ✅ FIX MEDIA RELATION
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'jadwal_id')
            ->where('ref_table', 'jadwal_posyandu');
    }

    public function layanan()
    {
        return $this->hasMany(
            LayananPosyandu::class,
            'jadwal_id',
            'jadwal_id'
        );
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    // Jadwal yang akan datang
    public function scopeUpcoming($query)
    {
        return $query->where('tanggal', '>=', now()->toDateString());
    }
}
