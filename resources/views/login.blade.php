<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        @vite('resources/css/app.css')
        <script src="https://cdn.jsdelivr.net/npm/alpinejs/dist/cdn.min.js"></script>
    </head>

    <body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-xl p-6 md:p-8 space-y-6">
                <!-- Logo atau Gambar (opsional) -->
                <div class="text-center">
                    <!-- Tambahkan logo di sini jika diperlukan -->
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                        Masuk ke akun Anda
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Selamat datang kembali! Silakan masukkan detail Anda
                    </p>
                </div>

                <!-- Tampilkan Pesan Error -->
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-alert type="warning" title="Error" message="{{ $error }}" />
                    @endforeach
                @endif

                <!-- Tampilkan Pesan Alert -->
                @if (session('error'))
                    <x-alert type="error" title="Error" message="{{ session('error') }}" />
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Field NIK -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                            NIK
                        </label>
                        <input id="username" name="username" type="text" autocomplete="username" required
                            class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder:text-slate-400 text-sm"
                            placeholder="Masukkan NIDN Anda">
                    </div>

                    <!-- Field Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Kata Sandi
                        </label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder:text-slate-400 text-sm"
                            placeholder="••••••••">
                    </div>

                    <!-- Ingat Saya & Lupa Kata Sandi -->
                    {{-- <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                Ingat saya
                            </label>
                        </div>
                    </div> --}}

                    <!-- Tombol Masuk -->
                    <button type="submit"
                        class="w-full mt-6 cursor-pointer flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </body>

</html>
