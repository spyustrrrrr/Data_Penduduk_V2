<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Manajemen Penduduk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <!-- Logo -->
            <div class="flex flex-col items-center mb-8">
                <div class="w-24 h-24 mb-4 rounded-2xl flex items-center justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo GERGAJI" class="w-full h-full object-contain">
                </div>
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-900">GERGAJI</h2>
                    <p class="text-sm text-gray-600">Data Warga RT</p>
                </div>
            </div>

            <!-- Login heading -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 pb-3 border-b-4 border-blue-600 inline-block">LOGIN</h1>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-circle text-red-600 text-lg mt-0.5"></i>
                        <div>
                            <h3 class="font-semibold text-red-900 text-sm mb-2">Login Gagal</h3>
                            <ul class="text-red-700 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email field -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Email atau Nomor Telepon</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-4 text-gray-400"></i>
                        <input type="email" name="email" required value="{{ old('email') }}" class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-gray-50 placeholder-gray-400" placeholder="Masukkan email atau nomor telepon">
                    </div>
                </div>

                <!-- Password field -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Kata Sandi</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-4 text-gray-400"></i>
                        <input type="password" name="password" required class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-gray-50 placeholder-gray-400" placeholder="Masukkan kata sandi">
                        <button type="button" class="absolute right-4 top-4 text-gray-400 hover:text-gray-600" onclick="togglePassword(this)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Forgot password link -->
                <div class="text-right">
                    <a href="#" class="text-sm text-blue-600 font-semibold hover:text-blue-700">Lupa Kata Sandi? Klik disini.</a>
                </div>

                <!-- Login button -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold py-3 rounded-lg hover:from-blue-700 hover:to-cyan-600 transition transform hover:scale-105 active:scale-95 shadow-lg">
                    MASUK
                </button>

                <!-- Divider -->
                <div class="flex items-center gap-4">
                    <div class="flex-1 h-px bg-gray-300"></div>
                    <span class="text-gray-500 text-sm">atau</span>
                    <div class="flex-1 h-px bg-gray-300"></div>
                </div>

                <!-- Register link -->
                <p class="text-center text-gray-600 text-sm">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:text-blue-700">Daftar sekarang</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(button) {
            const input = button.parentElement.querySelector('input');
            const icon = button.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>