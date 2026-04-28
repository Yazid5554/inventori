<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR — Inventaris</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-16">
            <div class="flex items-center gap-8">
                <span class="text-lg font-bold text-indigo-600">📦 Inventaris</span>
                <div class="flex gap-6 text-sm">
                    <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-indigo-600">Dashboard</a>
                    <a href="{{ route('barang.index') }}" class="text-gray-500 hover:text-indigo-600">Barang</a>
                    <a href="{{ route('lokasi.index') }}" class="text-gray-500 hover:text-indigo-600">Ruangan</a>
                    @if(auth()->user()->role === 'super_admin')
                    <a href="{{ route('users.index') }}" class="text-gray-500 hover:text-indigo-600">Users</a>
                    @endif
                    <a href="{{ route('scan.index') }}" class="text-indigo-600 font-medium">Scan QR</a>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">{{ auth()->user()->name }}</span>
                <span class="px-2 py-1 text-xs rounded-full
                    {{ auth()->user()->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ auth()->user()->role }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-500 hover:text-red-700">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-lg mx-auto px-6 py-8">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-900">Scan QR Code</h1>
            <p class="text-gray-500 text-sm mt-1">Arahkan kamera ke QR code barang</p>
        </div>

        {{-- Scanner Box --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">

            {{-- Status --}}
            <div id="status-box" class="mb-4 hidden">
                <div id="status-success" class="hidden bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 text-sm text-center">
                    ✅ QR terdeteksi! Mengalihkan ke detail barang...
                </div>
                <div id="status-error" class="hidden bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 text-sm text-center">
                    ❌ QR tidak dikenali. Pastikan QR dari sistem ini.
                </div>
            </div>

            {{-- Camera View --}}
            <div id="reader" class="w-full rounded-lg overflow-hidden"></div>

            {{-- Controls --}}
            <div class="flex gap-3 mt-4 justify-center">
                <button id="btn-start"
                    onclick="startScanner()"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                    📷 Mulai Kamera
                </button>
                <button id="btn-stop"
                    onclick="stopScanner()"
                    class="hidden bg-red-500 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition">
                    ⏹ Stop Kamera
                </button>
            </div>

            <p class="text-xs text-gray-400 text-center mt-3">
                Pastikan browser mendapat izin akses kamera
            </p>
        </div>

        {{-- Manual Input --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mt-4">
            <h2 class="font-semibold text-gray-900 mb-3 text-sm">Atau cari manual</h2>
            <form action="{{ route('barang.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="search"
                    placeholder="Nama barang atau nomor inventaris..."
                    class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition">
                    Cari
                </button>
            </form>
        </div>
    </div>

    <script>
        let html5QrCode = null;
        const baseUrl = "{{ url('/') }}";

        function startScanner() {
            document.getElementById('btn-start').classList.add('hidden');
            document.getElementById('btn-stop').classList.remove('hidden');
            document.getElementById('status-box').classList.add('hidden');
            document.getElementById('status-success').classList.add('hidden');
            document.getElementById('status-error').classList.add('hidden');

            html5QrCode = new Html5Qrcode("reader");

            html5QrCode.start({
                    facingMode: "environment"
                }, // Pakai kamera belakang
                {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    },
                },
                (decodedText) => {
                    // QR berhasil di-scan
                    onScanSuccess(decodedText);
                },
                (errorMessage) => {
                    // Scanning... (abaikan error ini)
                }
            ).catch((err) => {
                console.error("Gagal start kamera:", err);
                alert("Gagal akses kamera. Pastikan izin kamera sudah diberikan.");
                stopScanner();
            });
        }

        function stopScanner() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode.clear();
                    html5QrCode = null;
                });
            }
            document.getElementById('btn-start').classList.remove('hidden');
            document.getElementById('btn-stop').classList.add('hidden');
        }

        function onScanSuccess(decodedText) {
            // Stop scanner dulu
            stopScanner();

            document.getElementById('status-box').classList.remove('hidden');

            // Cek apakah URL dari sistem ini
            if (decodedText.startsWith(baseUrl + '/barang/')) {
                document.getElementById('status-success').classList.remove('hidden');
                // Redirect ke halaman detail barang
                setTimeout(() => {
                    window.location.href = decodedText;
                }, 1000);
            } else {
                document.getElementById('status-error').classList.remove('hidden');
            }
        }
    </script>

</body>

</html>