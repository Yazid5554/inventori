<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print QR — {{ $barang->nama }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            width: 280px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 13px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 12px;
            letter-spacing: 1px;
        }

        .qr-img {
            width: 180px;
            height: 180px;
            margin: 0 auto 16px;
            display: block;
        }

        .nama {
            font-size: 16px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 8px;
        }

        .info-table {
            width: 100%;
            font-size: 11px;
            color: #374151;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 3px 4px;
            text-align: left;
        }

        .info-table td:first-child {
            color: #6b7280;
            width: 45%;
        }

        .no-inventaris {
            margin-top: 12px;
            font-size: 10px;
            font-family: monospace;
            color: #4f46e5;
            background: #eef2ff;
            padding: 6px 10px;
            border-radius: 6px;
            word-break: break-all;
        }

        .btn-area {
            margin-top: 24px;
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        .btn-print {
            background: #4f46e5;
            color: white;
        }

        .btn-back {
            background: #e5e7eb;
            color: #374151;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        @media print {
            body {
                background: white;
            }

            .btn-area {
                display: none;
            }

            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>

<body>

    <div>
        <div class="card">
            <div class="logo">📦 INVENTARIS</div>

            <img src="{{ route('barang.qr', $barang) }}" class="qr-img" alt="QR Code">

            <div class="nama">{{ $barang->nama }}</div>

            <table class="info-table">
                <tr>
                    <td>Kode</td>
                    <td><strong>{{ $barang->kode_barang ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td>Ruangan</td>
                    <td>{{ $barang->lokasi?->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Gedung</td>
                    <td>{{ strtoupper($barang->lokasi?->gedung ?? '-') }}</td>
                </tr>
                <tr>
                    <td>Lantai</td>
                    <td>{{ $barang->lokasi?->lantai ?? '-' }}</td>
                </tr>
                @if($barang->tanggal_pengadaan)
                <tr>
                    <td>Tgl Pengadaan</td>
                    <td>{{ \Carbon\Carbon::parse($barang->tanggal_pengadaan)->format('d/m/Y') }}</td>
                </tr>
                @endif
            </table>

            <div class="no-inventaris">{{ $barang->nomor_inventaris ?? '-' }}</div>
        </div>

        <div class="btn-area">
            <a href="{{ route('barang.show', $barang) }}" class="btn btn-back">← Kembali</a>
            <button onclick="window.print()" class="btn btn-print">🖨️ Print</button>
        </div>
    </div>

</body>

</html>