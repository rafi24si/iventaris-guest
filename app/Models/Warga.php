<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table      = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable   = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function kaderPosyandu()
    {
        return $this->hasMany(KaderPosyandu::class, 'warga_id', 'warga_id');
    }

    public function layananPosyandu()
    {
        return $this->hasMany(
            LayananPosyandu::class,
            'warga_id',
            'warga_id'
        );
    }

}
