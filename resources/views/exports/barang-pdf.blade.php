<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Barang Inventaris</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 16px;
            font-weight: bold;
            color: #1e1b4b;
        }

        .header p {
            font-size: 11px;
            color: #666;
            margin-top: 4px;
        }

        .meta {
            margin-bottom: 15px;
            font-size: 10px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background-color: #4f46e5;
            color: white;
        }

        thead th {
            padding: 7px 6px;
            text-align: left;
            font-size: 10px;
        }

        tbody tr:nth-child(even) {
            background-color: #f5f5ff;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tbody td {
            padding: 6px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 10px;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
            background: #e0e7ff;
            color: #3730a3;
        }

        .footer {
            margin-top: 20px;
            font-size: 9px;
            color: #999;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>📦 Data Inventaris Barang</h1>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
    </div>

    <div class="meta">
        Total Barang: <strong>{{ $barangs->count() }}</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kode</th>
                <th>Nomor Inventaris</th>
                <th>Jenis</th>
                <th>Gedung</th>
                <th>Lantai</th>
                <th>Ruangan</th>
                <th>Tgl Pengadaan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $i => $b)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $b->nama }}</strong></td>
                <td><span class="badge">{{ $b->kode_barang ?? '-' }}</span></td>
                <td style="font-family: monospace; font-size: 9px;">{{ $b->nomor_inventaris ?? '-' }}</td>
                <td>{{ $b->jenis_barang ?? '-' }}</td>
                <td>{{ strtoupper($b->lokasi?->gedung ?? '-') }}</td>
                <td>{{ $b->lokasi?->lantai ?? '-' }}</td>
                <td>{{ $b->lokasi?->nama ?? '-' }}</td>
                <td>
                    @if($b->tanggal_pengadaan)
                    {{ \Carbon\Carbon::parse($b->tanggal_pengadaan)->format('d/m/Y') }}
                    @else
                    {{ $b->tahun_pengadaan ?? '-' }}
                    @endif
                </td>
                <td>{{ $b->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="10" style="text-align:center; padding: 20px; color: #999;">
                    Belum ada data barang
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Sistem Inventaris Barang — {{ date('Y') }}
    </div>
</body>

</html>