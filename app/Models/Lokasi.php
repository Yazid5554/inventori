<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';

    protected $fillable = ['nama', 'gedung', 'lantai', 'jenis', 'keterangan'];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_lokasi');
    }
}