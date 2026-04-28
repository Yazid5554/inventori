<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    protected $table = 'perbaikan';

    protected $fillable = [
        'id_barang',
        'id_pengguna',
        'tanggal_perbaikan',
        'deskripsi_kerusakan',
        'tindakan',
        'status',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}
