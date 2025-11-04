<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Manajemen Penduduk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #3b82f6;
            --secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --bg-light: #f8fafc;
            --border-color: #e2e8f0;
        }
        
        body {
            background-color: var(--bg-light);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        
        .sidebar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }
        
        .nav-item {
            transition: all 0.3s ease;
        }
        
        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }
        
        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid white;
        }
    </style>
</head>
<body>
    <div class="flex h-screen bg-gray-50">
        <!-- Modern sidebar navigation with gradient background -->
        <aside class="sidebar w-64 text-white shadow-lg flex flex-col">
            <div class="p-6 border-b border-white border-opacity-20">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center p-1 shadow-lg">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">GERGAJI</h1>
                        <p class="text-xs text-white text-opacity-70">Data Warga RT</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-white text-opacity-90 hover:text-opacity-100">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('residents.index') }}" class="nav-item {{ request()->routeIs('residents.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-white text-opacity-90 hover:text-opacity-100">
                    <i class="fas fa-id-card w-5"></i>
                    <span>Data Penduduk</span>
                </a>
                <a href="{{ route('kks.index') }}" class="nav-item {{ request()->routeIs('kks.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-white text-opacity-90 hover:text-opacity-100">
                    <i class="fas fa-home w-5"></i>
                    <span>Kartu Keluarga</span>
                </a>
                <a href="{{ route('charts.index') }}" class="nav-item {{ request()->routeIs('charts.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-white text-opacity-90 hover:text-opacity-100">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span>Grafik & Statistik</span>
                </a>
            </nav>

            <div class="p-4 border-t border-white border-opacity-20">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-white text-opacity-90 hover:bg-white hover:bg-opacity-10 transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <!-- Top Bar -->
            <div class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-10">
                <div class="px-8 py-4 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">@yield('title')</h2>
                    <div class="flex items-center gap-4">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-user-circle text-xl text-gray-400 mr-2"></i>
                            {{ auth()->user()->email }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-8">
                <!-- Improved alert styling with better visual hierarchy -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4 flex items-start gap-4">
                        <div class="text-red-600 text-xl mt-0.5">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-red-900 mb-2">Terjadi Kesalahan</h3>
                            <ul class="text-red-700 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-center gap-2">
                                        <span class="w-1 h-1 bg-red-600 rounded-full"></span>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex items-start gap-4">
                        <div class="text-green-600 text-xl mt-0.5">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-green-900">Berhasil</h3>
                            <p class="text-green-700 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
    
    @stack('scripts')
</body>
</html>