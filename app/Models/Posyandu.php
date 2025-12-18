<?php
namespace App\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    protected $table = 'posyandus';

    protected $primaryKey = 'posyandu_id';

    protected $fillable = [
        'nama',
        'alamat',
        'rt',
        'rw',
        'kontak',
    ];

    /**
     * Relasi ke media (CUSTOM POLYMORPHIC)
     * media.ref_table = 'posyandu'
     * media.ref_id    = posyandu_id
     */
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'posyandu_id')
            ->where('ref_table', 'posyandu');
    }

    /**
     * Ambil 1 foto utama (helper)
     */
    public function fotoUtama()
    {
        return $this->media()->orderBy('sort_order')->first();
    }

    public function kader()
    {
        return $this->hasMany(KaderPosyandu::class, 'posyandu_id', 'posyandu_id');
    }

}
