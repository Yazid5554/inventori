<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPerubahan extends Model
{
    protected $table = 'log_perubahan';

    protected $fillable = [
        'id_barang',
        'id_pengguna',
        'jenis_kejadian',
        'deskripsi',
        'nilai_lama',
        'nilai_baru',
    ];

    // Relasi: log ini milik satu barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    // Relasi: log ini dicatat oleh satu pengguna
    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}
