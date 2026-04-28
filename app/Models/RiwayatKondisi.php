<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKondisi extends Model
{
    protected $table = 'riwayat_kondisi';

    protected $fillable = [
        'id_barang',
        'id_pengguna',
        'kondisi',
        'catatan',
        'tanggal_pencatatan',
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
