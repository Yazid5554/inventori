<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrScan extends Model
{
    protected $table = 'qr_scans';

    public $timestamps = false;

    protected $fillable = [
        'id_barang',
        'scanned_by_ip',
        'user_agent',
        'scanned_at',
    ];

    protected $casts = [
        'scanned_at' => 'datetime',
    ];

    // Relasi: scan ini milik satu barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
