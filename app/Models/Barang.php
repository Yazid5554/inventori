<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
    'nama',
    'kode_barang',
    'nomor_inventaris',
    'jenis_barang',
    'tahun_pengadaan',
    'tanggal_pengadaan',
    'id_lokasi',
    'foto',
    'qr_code',
    'keterangan',
];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }

    public function riwayatKondisi()
    {
        return $this->hasMany(RiwayatKondisi::class, 'id_barang');
    }

    public function perbaikan()
    {
        return $this->hasMany(Perbaikan::class, 'id_barang');
    }

    public function kerusakan()
    {
        return $this->hasMany(Kerusakan::class, 'id_barang');
    }
    public function komponen()
    {
        return $this->hasMany(Komponen::class, 'id_barang');
    }
    
}