<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportExcel()
    {
        $filename = 'data-barang-' . date('d-m-Y') . '.xlsx';
        return Excel::download(new BarangExport, $filename);
    }

    public function exportPdf()
    {
        $barangs = Barang::with('lokasi')->latest()->get();

        $pdf = Pdf::loadView('exports.barang-pdf', compact('barangs'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('data-barang-' . date('d-m-Y') . '.pdf');
    }
}
