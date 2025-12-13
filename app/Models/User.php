<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    // Kolom yang bisa diisi
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',           // ← Role user
        'profile_photo',  // ← Foto profil
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Scope Filter
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        // Other filters
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $value = $request->input($column);

                if ($column === 'email_verified_at') {
                    // Verified / unverified filter
                    $value === 'verified'
                        ? $query->whereNotNull('email_verified_at')
                        : $query->whereNull('email_verified_at');
                } else {
                    $query->where($column, $value);
                }
            }
        }

        return $query;
    }

    /**
     * ROLE HELPERS
     */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPetugas()
    {
        return $this->role === 'petugas';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function hasRole($roles)
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }
        return $this->role === $roles;
    }

    /**
     * Ambil URL foto profil
     */
    public function getPhotoUrl()
    {
        if (!$this->profile_photo) {
            return asset('default/default-user.png'); // fallback gambar default
        }

        return asset('storage/' . $this->profile_photo);
    }
}
