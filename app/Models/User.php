<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'avatar',
];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password'  => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Cek apakah user adalah super admin
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    // Cek apakah user adalah admin biasa
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Relasi: satu user bisa punya banyak log perubahan
    public function logPerubahan()
    {
        return $this->hasMany(LogPerubahan::class, 'id_pengguna');
    }

    // Relasi: satu user bisa punya banyak riwayat kondisi
    public function riwayatKondisi()
    {
        return $this->hasMany(RiwayatKondisi::class, 'id_pengguna');
    }

    // Relasi: satu user bisa punya banyak catatan perbaikan
    public function perbaikan()
    {
        return $this->hasMany(Perbaikan::class, 'id_pengguna');
    }

    // Relasi: satu user bisa punya banyak laporan kerusakan
    public function kerusakan()
    {
        return $this->hasMany(Kerusakan::class, 'id_pengguna');
    }
}
