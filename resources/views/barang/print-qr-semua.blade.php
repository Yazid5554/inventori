<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print QR Semua Barang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 20px;
        }

        .top-bar {
            text-align: center;
            margin-bottom: 24px;
        }

        .top-bar h1 {
            font-size: 20px;
            font-weight: bold;
            color: #1e1b4b;
        }

        .top-bar p {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        .btn-area {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 24px;
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

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            max-width: 900px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
            page-break-inside: avoid;
        }

        .logo {
            font-size: 10px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .qr-img {
            width: 140px;
            height: 140px;
            margin: 0 auto 10px;
            display: block;
        }

        .nama {
            font-size: 13px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 6px;
        }

        .info-table {
            width: 100%;
            font-size: 10px;
            color: #374151;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 2px 3px;
            text-align: left;
        }

        .info-table td:first-child {
            color: #6b7280;
            width: 45%;
        }

        .no-inventaris {
            margin-top: 8px;
            font-size: 8px;
            font-family: monospace;
            color: #4f46e5;
            background: #eef2ff;
            padding: 4px 8px;
            border-radius: 4px;
            word-break: break-all;
        }

        @media print {
            body {
                background: white;
                padding: 10px;
            }

            .btn-area,
            .top-bar {
                display: none;
            }

            .card {
                box-shadow: none;
            }

            .grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="top-bar">
        <h1>📦 Print QR Code — Semua Barang</h1>
        <p>Total {{ $barangs->count() }} barang</p>
    </div>

    <div class="btn-area">
        <a href="{{ route('barang.index') }}" class="btn btn-back">← Kembali</a>
        <button onclick="window.print()" class="btn btn-print">🖨️ Print Semua</button>
    </div>

    <div class="grid">
        @foreach($barangs as $b)
        <div class="card">
            <div class="logo">📦 INVENTARIS</div>

            <img src="{{ route('barang.qr', $b) }}" class="qr-img" alt="QR">

            <div class="nama">{{ $b->nama }}</div>

            <table class="info-table">
                <tr>
                    <td>Kode</td>
                    <td><strong>{{ $b->kode_barang ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td>Ruangan</td>
                    <td>{{ $b->lokasi?->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Gedung</td>
                    <td>{{ strtoupper($b->lokasi?->gedung ?? '-') }}</td>
                </tr>
                <tr>
                    <td>Lantai</td>
                    <td>{{ $b->lokasi?->lantai ?? '-' }}</td>
                </tr>
            </table>

            <div class="no-inventaris">{{ $b->nomor_inventaris ?? '-' }}</div>
        </div>
        @endforeach
    </div>

</body>

</html>