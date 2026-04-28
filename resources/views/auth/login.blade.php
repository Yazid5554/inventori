<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistem Inventaris</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

        {{-- Logo / Judul --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Sistem Inventaris</h1>
            <p class="text-gray-500 text-sm mt-1">Masuk untuk melanjutkan</p>
        </div>

        {{-- Alert error --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-6 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form login --}}
       <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="contoh@email.com"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('email') border-red-400 @enderror"
                    autofocus
                >
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                >
            </div>

            {{-- Remember me --}}
            <div class="flex items-center mb-6">
                <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-green-600">
                <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
            </div>

            {{-- Tombol login --}}
            <button
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 rounded-lg transition duration-200"
            >
                Masuk
            </button>
        </form>

    </div>

</body>
</html>