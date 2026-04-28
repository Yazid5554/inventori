<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    protected $table = 'komponen';

    protected $fillable = [
        'id_barang',
        'jenis_komponen',
        'merek',
        'spesifikasi',
        'kondisi',
        'catatan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
