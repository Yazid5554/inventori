<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventaris') — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes slideInLeft {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-sidebar {
            animation: slideInLeft 1.2s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen overflow-hidden flex">

    {{-- Sidebar --}}
    <aside id="sidebar" class="w-60 min-h-screen bg-[#1a2f6e] flex flex-col fixed top-0 left-0 z-30 transition-all duration-300 overflow-hidden">

        {{-- Avatar & Nama --}}
        <div class="flex flex-col items-center pt-10 pb-2 px-4 overflow-hidden animate-sidebar" style="animation-delay: 0ms;">

            {{-- Avatar --}}
            <div id="sidebar-avatar" class="w-32 h-32 rounded-full bg-blue-100 flex items-center justify-center mb-3 border-4 border-white/20 transition-all duration-300 flex-shrink-0 shadow-lg overflow-hidden">
                @if(auth()->user()->avatar)
                <img src="{{ Storage::url(auth()->user()->avatar) }}" class="w-full h-full object-cover">
                @else
                <svg class="w-16 h-16 text-[#1a2f6e] transition-all duration-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
                @endif
            </div>

            {{-- Nama User --}}
            <p id="sidebar-name" class="text-white font-bold text-2xl truncate text-center max-w-full px-2">
                {{ auth()->user()->name }}
            </p>

            {{-- Divider --}}
            <div id="sidebar-divider" class="w-44 h-0.5 bg-white/40 mt-3 mb-2"></div>

        </div>

        {{-- Navigation --}}
        <nav class="flex-1 pt-2 pb-4 px-3 space-y-1 z-10 overflow-x-hidden">
            <a href="{{ route('dashboard') }}" style="animation-delay: 200ms;"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 animate-sidebar
                {{ request()->routeIs('dashboard')
                    ? 'bg-blue-600 text-white shadow-md'
                    : 'text-gray-300 hover:bg-blue-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('barang.index') }}" style="animation-delay: 400ms;"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 animate-sidebar
                {{ request()->routeIs('barang.*')
                    ? 'bg-blue-600 text-white shadow-md'
                    : 'text-gray-300 hover:bg-blue-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Barang</span>
            </a>

            <a href="{{ route('lokasi.index') }}" style="animation-delay: 600ms;"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 animate-sidebar
                {{ request()->routeIs('lokasi.*')
                    ? 'bg-blue-600 text-white shadow-md'
                    : 'text-gray-300 hover:bg-blue-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Ruangan</span>
            </a>

            @if(auth()->check() && auth()->user()->role === 'super_admin')
            <a href="{{ route('users.index') }}" style="animation-delay: 800ms;"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 animate-sidebar
                {{ request()->routeIs('users.*')
                    ? 'bg-blue-600 text-white shadow-md'
                    : 'text-gray-300 hover:bg-blue-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Users</span>
            </a>
            @endif
        </nav>

        {{-- System Info Box --}}
        <div class="px-4 mb-2 z-10 system-info-box transition-all duration-300 animate-sidebar" style="animation-delay: 1000ms;">
            <div class="bg-white/10 rounded-xl p-4 border border-white/10 backdrop-blur-md shadow-lg">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-[11px] font-semibold text-blue-200 uppercase tracking-wider">Kapasitas Server</span>
                    <span class="text-[11px] font-bold text-white">74%</span>
                </div>
                <div class="w-full bg-[#1a2f6e] rounded-full h-1.5 mb-3 overflow-hidden">
                    <div class="bg-blue-400 h-1.5 rounded-full" style="width: 74%"></div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-[10px] text-blue-200 tracking-wide uppercase font-bold">Sistem Online</span>
                </div>
            </div>
        </div>

        {{-- Collapse Button --}}
        <div class="w-full py-4 flex justify-center z-10 border-t border-white/10 mt-auto animate-sidebar" style="animation-delay: 1200ms;">
            <button onclick="toggleSidebar()"
                class="flex items-center justify-center w-10 h-10 rounded-full bg-white/5 border border-white/20 hover:bg-white/10 transition text-white backdrop-blur-sm shadow-sm">
                <svg id="collapse-icon" class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>

        {{-- Watermark Background --}}
        <svg class="w-80 h-80 text-white/[0.03] absolute -bottom-16 -left-16 z-0 pointer-events-none transform -rotate-12" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z" />
            <path fill-rule="evenodd" d="M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.163 3.75A.75.75 0 0110 12h4a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
        </svg>

    </aside>

    {{-- Main Content --}}
    <div id="main-content" class="flex-1 ml-60 flex flex-col h-screen overflow-y-auto transition-all duration-300">

        {{-- Top Header --}}
        <header class="bg-white border-b border-gray-200 px-6 py-3 flex items-center justify-between sticky top-0 z-20">
            <div class="flex-1 max-w-xl">
                <form action="{{ route('barang.index') }}" method="GET" class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" placeholder="Cari inventaris, ruangan, atau laporan..."
                        class="w-full pl-9 pr-4 py-2 bg-gray-100 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                        value="{{ request('search') }}">
                </form>
            </div>

            <div class="flex items-center gap-4 ml-4">
                {{-- QR Scan Icon --}}
                <a href="{{ route('scan.index') }}" class="text-gray-500 hover:text-[#1a2f6e] transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                    </svg>
                </a>
                <div class="w-px h-6 bg-gray-300/40"></div>

                {{-- User Dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 text-sm text-gray-700 hover:text-[#1a2f6e] transition">
                        @if(auth()->user()->avatar)
                        <img src="{{ Storage::url(auth()->user()->avatar) }}"
                            class="w-8 h-8 rounded-full object-cover border-2 border-gray-200">
                        @else
                        <div class="w-8 h-8 rounded-full bg-[#1a2f6e] flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        @endif
                        <span class="font-medium">My Account</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" @click.outside="open = false"
                        class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-100 z-50">

                        {{-- User Info --}}
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                @if(auth()->user()->avatar)
                                <img src="{{ Storage::url(auth()->user()->avatar) }}"
                                    class="w-10 h-10 rounded-full object-cover">
                                @else
                                <div class="w-10 h-10 rounded-full bg-[#1a2f6e] flex items-center justify-center text-white text-sm font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                                @endif
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Upload Avatar --}}
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-xs text-gray-400 mb-2 font-medium uppercase tracking-wide">Ganti Foto Profil</p>
                            <div class="flex gap-2 items-center">
                                <input type="file" name="avatar_raw" accept="image/*" id="avatar-input"
                                    class="hidden" onchange="openCropper(this)">
                                <label for="avatar-input"
                                    class="cursor-pointer flex items-center gap-2 text-xs text-[#1a2f6e] border border-[#1a2f6e] px-3 py-1.5 rounded-lg hover:bg-blue-50 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Pilih Foto
                                </label>
                                <span class="text-xs text-gray-400">Max 2MB</span>
                            </div>
                        </div>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition rounded-b-xl flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="flash-message fixed right-6 z-50 w-[320px] bg-green-50 border border-green-200 text-green-800 rounded-2xl px-4 py-3 text-sm flex justify-between items-start gap-3 shadow-lg ring-1 ring-green-100 transition-all duration-300" style="top:4.5rem;">
            <span class="flex-1">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-600 font-bold">×</button>
        </div>
        @endif
        @if(session('error'))
        <div class="flash-message fixed right-6 z-50 w-[320px] bg-red-50 border border-red-200 text-red-800 rounded-2xl px-4 py-3 text-sm flex justify-between items-start gap-3 shadow-lg ring-1 ring-red-100 transition-all duration-300" style="top:4.5rem;">
            <span class="flex-1">{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="text-red-600 font-bold">×</button>
        </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 p-4 overflow-hidden flex flex-col">
            @yield('content')
        </main>
    </div>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Sidebar Toggle Script --}}
    <script>
        function applySidebarState(isCollapsed, animate = true) {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main-content');
            const icon = document.getElementById('collapse-icon');
            const avatar = document.getElementById('sidebar-avatar');
            const avatarSvg = avatar ? avatar.querySelector('svg') : null;
            const sidebarName = document.getElementById('sidebar-name');
            const sidebarDivider = document.getElementById('sidebar-divider');

            if (!animate) {
                sidebar.style.transition = 'none';
                main.style.transition = 'none';
                if (avatar) avatar.style.transition = 'none';
            }

            if (isCollapsed) {
                sidebar.classList.replace('w-60', 'w-16');
                main.classList.replace('ml-60', 'ml-16');

                // Sembunyikan teks nav, nama, divider, system info
                document.querySelectorAll('#sidebar nav a span, .system-info-box').forEach(el => {
                    el.classList.add('hidden');
                });
                if (sidebarName) sidebarName.classList.add('hidden');
                if (sidebarDivider) sidebarDivider.classList.add('hidden');

                // Pusatkan icon nav
                document.querySelectorAll('#sidebar nav a').forEach(el => {
                    el.classList.replace('px-4', 'px-0');
                    el.classList.add('justify-center');
                });

                // Kecilkan avatar
                if (avatar) {
                    avatar.classList.remove('w-24', 'w-32');
                    avatar.classList.add('w-10');
                    avatar.classList.remove('h-24', 'h-32');
                    avatar.classList.add('h-10');
                    avatar.classList.replace('border-4', 'border-2');
                }
                if (avatarSvg) {
                    avatarSvg.classList.remove('w-14', 'w-16');
                    avatarSvg.classList.add('w-6');
                    avatarSvg.classList.remove('h-14', 'h-16');
                    avatarSvg.classList.add('h-6');
                }

                icon.classList.add('rotate-180');

            } else {
                sidebar.classList.replace('w-16', 'w-60');
                main.classList.replace('ml-16', 'ml-60');

                // Tampilkan kembali
                document.querySelectorAll('#sidebar nav a span, .system-info-box').forEach(el => {
                    el.classList.remove('hidden');
                });
                if (sidebarName) sidebarName.classList.remove('hidden');
                if (sidebarDivider) sidebarDivider.classList.remove('hidden');

                // Kembalikan padding nav
                document.querySelectorAll('#sidebar nav a').forEach(el => {
                    el.classList.replace('px-0', 'px-4');
                    el.classList.remove('justify-center');
                });

                // Besarkan avatar
                if (avatar) {
                    avatar.classList.remove('w-10');
                    avatar.classList.add('w-32');
                    avatar.classList.remove('h-10');
                    avatar.classList.add('h-32');
                    avatar.classList.replace('border-2', 'border-4');
                }
                if (avatarSvg) {
                    avatarSvg.classList.remove('w-6');
                    avatarSvg.classList.add('w-16');
                    avatarSvg.classList.remove('h-6');
                    avatarSvg.classList.add('h-16');
                }

                icon.classList.remove('rotate-180');
            }

            if (!animate) {
                void sidebar.offsetHeight;
                sidebar.style.transition = '';
                main.style.transition = '';
                if (avatar) avatar.style.transition = '';
            }
        }

        function toggleSidebar() {
            const isCollapsed = localStorage.getItem('sidebar_collapsed') === 'true';
            localStorage.setItem('sidebar_collapsed', !isCollapsed);
            applySidebarState(!isCollapsed, true);
        }

        // Apply state on load
        const isCollapsed = localStorage.getItem('sidebar_collapsed') === 'true';
        if (isCollapsed) {
            applySidebarState(true, false);
        }

        // Auto-hide flash messages after 3.5 seconds
        document.querySelectorAll('.flash-message').forEach(el => {
            setTimeout(() => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => el.remove(), 500);
            }, 4000);
        });
    </script>

    {{-- Modal Cropper --}}
    <div id="cropper-modal" class="fixed inset-0 z-[999] bg-black/60 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">

            {{-- Header --}}
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-gray-800">Atur Foto Profil</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Geser & zoom untuk mengatur posisi foto</p>
                </div>
                <button onclick="closeCropper()" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Crop Area --}}
            <div class="p-5">
                <div class="relative w-full bg-gray-900 rounded-xl overflow-hidden" style="height: 280px;">
                    <img id="cropper-image" src="" alt="crop" class="max-w-full">
                </div>

                {{-- Zoom Controls --}}
                <div class="flex items-center gap-3 mt-4">
                    <span class="text-xs text-gray-400">Zoom</span>
                    <input type="range" id="zoom-slider" min="0" max="3" step="0.01" value="0"
                        class="flex-1 accent-blue-600"
                        oninput="cropperInstance.zoom(parseFloat(this.value) - currentZoom); currentZoom = parseFloat(this.value);">
                    <span class="text-xs text-gray-400">Putar</span>
                    <button onclick="cropperInstance.rotate(-90)" class="text-xs border border-gray-200 px-2 py-1 rounded-lg hover:bg-gray-50 transition">↺</button>
                    <button onclick="cropperInstance.rotate(90)" class="text-xs border border-gray-200 px-2 py-1 rounded-lg hover:bg-gray-50 transition">↻</button>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-5 py-4 border-t border-gray-100 flex justify-end gap-3">
                <button onclick="closeCropper()"
                    class="px-4 py-2 text-sm text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </button>
                <button onclick="saveCrop()"
                    class="px-4 py-2 text-sm text-white bg-[#1a2f6e] rounded-lg hover:bg-blue-800 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Foto
                </button>
            </div>
        </div>
    </div>

    {{-- Form hidden untuk submit hasil crop --}}
    <form id="avatar-form" method="POST" action="{{ route('profile.avatar.update') }}">
        @csrf
        <input type="hidden" name="avatar_cropped" id="avatar-cropped-input">
    </form>

    {{-- Cropper.js CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

    <script>
        let cropperInstance = null;
        let currentZoom = 0;

        function openCropper(input) {
            if (!input.files || !input.files[0]) return;

            const file = input.files[0];

            // Validasi ukuran (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran foto maksimal 2MB.');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const image = document.getElementById('cropper-image');
                image.src = e.target.result;

                // Tampilkan modal
                document.getElementById('cropper-modal').classList.remove('hidden');

                // Destroy cropper lama kalau ada
                if (cropperInstance) {
                    cropperInstance.destroy();
                    cropperInstance = null;
                }

                // Reset zoom slider
                currentZoom = 0;
                document.getElementById('zoom-slider').value = 0;

                // Init cropper baru
                cropperInstance = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    restore: false,
                    guides: true,
                    center: true,
                    highlight: false,
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                    zoom(event) {
                        currentZoom = event.detail.ratio;
                        document.getElementById('zoom-slider').value = currentZoom;
                    },
                });
            };
            reader.readAsDataURL(file);
        }

        function closeCropper() {
            document.getElementById('cropper-modal').classList.add('hidden');
            if (cropperInstance) {
                cropperInstance.destroy();
                cropperInstance = null;
            }
            document.getElementById('avatar-input').value = '';
        }

        function saveCrop() {
            if (!cropperInstance) return;

            const canvas = cropperInstance.getCroppedCanvas({
                width: 400,
                height: 400,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            const base64 = canvas.toDataURL('image/jpeg', 0.9);

            document.getElementById('avatar-cropped-input').value = base64;
            document.getElementById('avatar-form').submit();

            closeCropper();
        }
    </script>

</body>

</html>