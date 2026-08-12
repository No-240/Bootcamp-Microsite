<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', 'Microsite Admin')</title>

    {{-- Font & CSS --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet" />

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- Custom Style --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }
        .sidebar-link {
            transition: all 0.2s ease;
        }
        .sidebar-link:hover {
            background: #e2e8f0;
            transform: translateX(4px);
        }
        .sidebar-link.active {
            background: #e2e8f0;
            font-weight: 600;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    {{-- ============================================ --}}
    {{-- SIDEBAR --}}
    {{-- ============================================ --}}
    <aside class="fixed top-0 left-0 h-full w-64 bg-white border-r border-gray-200 shadow-sm z-50 flex flex-col">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">
                <span class="text-blue-600"></span> CV JAYA GIRY
            </h1>
            <p class="text-sm text-gray-500 mt-1">Yuda Maulana</p>
        </div>

        <nav class="p-4 space-y-2 flex-1">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.links.index') }}" class="sidebar-link {{ request()->routeIs('admin.links.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                <i data-lucide="link" class="w-5 h-5"></i>
                <span>Semua Links</span>
            </a>
            <a href="{{ route('admin.links.create') }}" class="sidebar-link {{ request()->routeIs('admin.links.create') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                <i data-lucide="plus-circle" class="w-5 h-5"></i>
                <span>Tambah Link</span>
            </a>
        </nav>

        {{-- Preview Public Button --}}
        <div class="p-4 border-t border-gray-200">
            <a href="{{ route('public.index') }}" target="_blank" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2.5 rounded-lg text-sm transition-all duration-200 flex items-center justify-center gap-2 shadow-sm">
                <span>Preview Public</span>
                <i data-lucide="external-link" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="w-full p-4 border-t border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                    A
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">Admin User</p>
                    <p class="text-xs text-gray-500">admin@microsite.com</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- ============================================ --}}
    {{-- MAIN CONTENT --}}
    {{-- ============================================ --}}
    <div class="ml-64 min-h-screen flex flex-col flex-1">
        {{-- Header --}}
        <header class="bg-white border-b border-gray-200 px-8 py-4 sticky top-0 z-40 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">
                    @yield('page-title', 'Dashboard')
                </h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-500">{{ now()->format('d F Y') }}</span>
                </div>
                <!-- Form Aksi Logout (HTTP POST) -->
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit"
                            class="bg-rose-200 hover:bg-rose-300 text-slate-900 font-bold text-xs sm:text-sm px-3 py-2 sm:px-5 sm:py-2.5 rounded-lg sm:rounded-xl border-2 border-slate-900 shadow-[2px_2px_0px_0px_#0f172a] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all flex items-center gap-1.5 sm:gap-2">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span class="hidden sm:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </header>

        {{-- ============================================ --}}
        {{-- CONTENT + FLASH MESSAGES --}}
        {{-- ============================================ --}}
        <main class="max-w-7xl mx-auto py-6 sm:py-10 px-4 sm:px-6 lg:px-8 flex-grow w-full">
            {{-- Flash Message Notification (Success) --}}
            @if(session('success'))
                <div class="mb-6 p-4 sm:p-5 bg-emerald-200 text-emerald-950 font-extrabold rounded-2xl border-2 border-slate-900 shadow-[4px_4px_0px_0px_#0f172a] flex items-center gap-3">
                    <i data-lucide="check-circle-2" class="w-6 h-6 text-emerald-800 shrink-0"></i>
                    <span class="text-sm sm:text-base">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Flash Message Notification (Error) --}}
            @if(session('error'))
                <div class="mb-6 p-4 sm:p-5 bg-red-200 text-red-950 font-extrabold rounded-2xl border-2 border-slate-900 shadow-[4px_4px_0px_0px_#0f172a] flex items-center gap-3">
                    <i data-lucide="alert-circle" class="w-6 h-6 text-red-800 shrink-0"></i>
                    <span class="text-sm sm:text-base">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Yield Content dari Child View --}}
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="bg-white border-t border-slate-200 text-center py-6 px-4 text-xs font-medium text-slate-500 mt-auto">
            &copy; {{ date('Y') }} &bull; HELLO
        </footer>
    </div>

    {{-- ============================================ --}}
    {{-- SCRIPTS --}}
    {{-- ============================================ --}}
    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>
