<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Perbaikan;
use App\Models\RiwayatKondisi;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_barang'    => Barang::count(),
            'total_lokasi'    => Lokasi::count(),
            'perbaikan_aktif' => \App\Models\Perbaikan::whereIn('status', ['menunggu', 'sedang_diperbaiki'])->count(),
            'kondisi_baik'    => RiwayatKondisi::where('kondisi', 'baik')
                                    ->whereIn('id', RiwayatKondisi::selectRaw('MAX(id) as id')->groupBy('id_barang'))
                                    ->count(),
            'kondisi_rusak'   => RiwayatKondisi::where('kondisi', 'rusak')
                                    ->whereIn('id', RiwayatKondisi::selectRaw('MAX(id) as id')->groupBy('id_barang'))
                                    ->count(),
        ];

        $barang_terbaru = Barang::with('lokasi')->latest()->paginate(5);

        return view('dashboard', compact('stats', 'barang_terbaru'));
    }
}