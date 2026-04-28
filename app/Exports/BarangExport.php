<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Barang::with('lokasi')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Barang',
            'Kode Barang',
            'Nomor Inventaris',
            'Jenis Barang',
            'Gedung',
            'Lantai',
            'Ruangan',
            'Tanggal Pengadaan',
            'Keterangan',
        ];
    }

    public function map($barang): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $barang->nama,
            $barang->kode_barang ?? '-',
            $barang->nomor_inventaris ?? '-',
            $barang->jenis_barang ?? '-',
            strtoupper($barang->lokasi?->gedung ?? '-'),
            $barang->lokasi?->lantai ?? '-',
            $barang->lokasi?->nama ?? '-',
            $barang->tanggal_pengadaan
                ? \Carbon\Carbon::parse($barang->tanggal_pengadaan)->format('d/m/Y')
                : ($barang->tahun_pengadaan ?? '-'),
            $barang->keterangan ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill'      => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF4F46E5']],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }
}
