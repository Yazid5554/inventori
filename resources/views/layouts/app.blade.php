<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventaris') — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="text-lg font-bold text-indigo-600">
                        📦 Inventaris
                    </a>
                    @auth
                    <div class="hidden md:flex gap-4 text-sm">
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-600 hover:text-indigo-600 {{ request()->routeIs('dashboard') ? 'text-indigo-600 font-medium' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('barang.index') }}"
                            class="text-gray-600 hover:text-indigo-600 {{ request()->routeIs('barang.*') ? 'text-indigo-600 font-medium' : '' }}">
                            Barang
                        </a>

                        <a href="{{ route('lokasi.index') }}"
                            class="text-gray-600 hover:text-indigo-600 {{ request()->routeIs('lokasi.*') ? 'text-indigo-600 font-medium' : '' }}">
                            Ruangan
                        </a>
                        @if(auth()->user()->role === 'super_admin')
                        <a href="{{ route('users.index') }}"
                            class="text-gray-600 hover:text-indigo-600 {{ request()->routeIs('users.*') ? 'text-indigo-600 font-medium' : '' }}">
                            Users
                        </a>
                        @endif
                        <a href="{{ route('scan.index') }}"
                            class="text-gray-600 hover:text-indigo-600 {{ request()->routeIs('scan.*') ? 'text-indigo-600 font-medium' : '' }}">
                            Scan QR
                        </a>
                    </div>
                    @endauth
                </div>
                @auth
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500">
                        {{ auth()->user()->name }}
                        <span class="ml-1 px-2 py-0.5 text-xs rounded-full
                            {{ auth()->user()->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ auth()->user()->role }}
                        </span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-500 hover:text-red-700">Logout</button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Flash messages --}}
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 text-sm flex justify-between">
            {{ session('success') }}
            <button onclick="this.parentElement.remove()" class="text-green-600 font-bold">×</button>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 text-sm flex justify-between">
            {{ session('error') }}
            <button onclick="this.parentElement.remove()" class="text-red-600 font-bold">×</button>
        </div>
    </div>
    @endif

    {{-- Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

</body>

</html>