<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    protected $table = 'kerusakan';

    protected $fillable = [
        'id_barang',
        'id_pengguna',
        'tanggal_kerusakan',
        'deskripsi',
        'tingkat_kerusakan',
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
