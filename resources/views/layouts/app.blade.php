<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - GERGAJI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #7abbf5 0%, #2ca8f0 100%);
            min-height: 100vh;
        }

        .sidebar {
            background: linear-gradient(180deg, #1e3a5f 0%, #0f2847 100%);
        }

        .nav-item {
            transition: all 0.3s ease;
        }

        .nav-item:hover {
            background-color: rgba(59, 130, 246, 0.2);
        }

        .nav-item.active {
            background-color: rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-64 text-white shadow-2xl flex flex-col fixed h-full z-50">
            <!-- Close Button (always visible) -->

            <!-- Logo Section -->
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-sky-800 rounded-xl flex items-center justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo GERGAJI" class="w-full h-full object-contain rounded-full">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Gergaji</h1>
                    </div>
                    <button id="closeSidebar" class=" text-white ms-3">
                        <i class="fas fa-times text-4xl"></i>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg">
                    <i class="fas fa-home w-5"></i>
                    <span>Beranda</span>
                </a>
                @auth
                    @if (Auth::user()->isSuperAdmin())
                        <a href="{{ route('admins.index') }}" class="nav-item {{ request()->routeIs('admins.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg">
                            <i class="fas fa-user-shield w-5"></i>
                            <span>Manajemen Admin</span>
                        </a>
                    @endif
                @endauth
                <a href="{{ route('residents.index') }}" class="nav-item {{ request()->routeIs('residents.index') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg">
                    <i class="fas fa-table w-5"></i>
                    <span>Rekap Data Warga</span>
                </a>
                <a href="{{ route('residents.create') }}" class="nav-item {{ request()->routeIs('residents.create') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg">
                    <i class="fas fa-user-plus w-5"></i>
                    <span>Entry Data </span>
                </a>
                <a href="{{ route('charts.index') }}" class="nav-item {{ request()->routeIs('charts.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span>Grafik</span>
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-t border-white/20">
                @auth
                    <div class="mb-3 px-4">
                        <span class="text-2xl capitalize font-bold">Username :  </span><span class="font-semibold text-white text-2xl capitalize">{{ auth()->user()->name }}</span>
                    </div>
                @endauth

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-white bg-red-600 hover:bg-red-700 transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <!-- Mobile Menu Button (always visible) -->
            <button id="openSidebar" class="fixed top-5 left-5 z-40 bg-sky-800 rounded-3xl px-5 py-4 shadow-lg">
                <i class="fas fa-bars text-white text-3xl"></i>
            </button>

            <!-- Content Area -->
            <div class="max-w-7xl mx-auto">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-start gap-4">
                            <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                            <div>
                                <h3 class="font-semibold text-red-900 mb-2">Terjadi Kesalahan</h3>
                                <ul class="text-red-700 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-start gap-4">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <div>
                                <h3 class="font-semibold text-green-900">Berhasil</h3>
                                <p class="text-green-700 text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Mobile sidebar toggle
        const sidebar = document.querySelector('aside');
        const openBtn = document.getElementById('openSidebar');
        const closeBtn = document.getElementById('closeSidebar');

        openBtn?.addEventListener('click', () => {
            sidebar.classList.remove('hidden');
        });

        closeBtn?.addEventListener('click', () => {
            sidebar.classList.add('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
