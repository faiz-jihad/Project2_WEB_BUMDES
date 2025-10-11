<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-purple-500 to-pink-500 relative overflow-hidden">

    <!-- Efek blur lingkaran -->
    <div class="absolute w-80 h-80 bg-white/20 rounded-full blur-3xl top-20 left-10 animate-pulse"></div>
    <div class="absolute w-96 h-96 bg-pink-300/30 rounded-full blur-3xl bottom-10 right-10 animate-pulse"></div>

    <!-- Card Login -->
    <div
        class="relative z-10 w-full max-w-md p-8 bg-white/20 backdrop-blur-2xl border border-white/30 rounded-2xl shadow-2xl text-white">
        <h1 class="text-3xl font-bold text-center mb-2">Selamat Datang</h1>
        <p class="text-center text-white/80 mb-6"></p>

        <!-- Pesan sukses dari register -->
        @if (session('success'))
            <div class="mb-4 p-3 text-sm text-green-800 bg-green-100/80 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <input type="email" name="email" placeholder="Email"
                    class="w-full px-4 py-3 rounded-xl bg-white/70 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                    required autofocus value="{{ old('email') }}">
            </div>

            <!-- Password -->
            <div class="mb-4 relative">
                <x-input-label for="password" :value="__('Password')" class="mb-1" />
                <div class="relative">
                    <x-text-input id="password"
                        class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        type="password" name="password" required autocomplete="current-password" />

                    <!-- Eye SVG (toggle) -->
                    <button type="button" id="togglePassword"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none"
                        aria-label="Toggle password visibility">
                        <!-- Mata terbuka -->
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <!-- Mata tertutup -->
                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.271-3.284M6.343 6.343A9.969 9.969 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.969 9.969 0 01-1.722 2.875M3 3l18 18" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-between items-center text-sm">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-500 focus:ring-indigo-400">
                    <span class="ml-2 text-white/90">Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-indigo-200 hover:underline">Lupa Password?</a>
                @endif
            </div>

            <button type="submit"
                class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 transition font-semibold shadow-lg shadow-indigo-500/30">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-white hover:underline">Daftar Sekarang</a>
        </p>

        <!-- Tombol login Google -->
        <div class="mt-8">
            <button
                class="flex items-center justify-center gap-2 w-full py-3 bg-white text-gray-700 rounded-xl hover:bg-gray-100 transition">
                <svg viewBox="0 0 48 48" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8 c-6.627,0-12-5.373-12-12
                        c0-6.627,5.373-12,12-12 c3.059,0,5.842,1.154,7.961,3.039 l5.657-5.657
                        C34.046,6.053,29.268,4,24,4 C12.955,4,4,12.955,4,24
                        c0,11.045,8.955,20,20,20 c11.045,0,20-8.955,20-20
                        C44,22.659,43.862,21.35,43.611,20.083z"></path>
                    <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819
                        C14.655,15.108,18.961,12,24,12
                        c3.059,0,5.842,1.154,7.961,3.039 l5.657-5.657
                        C34.046,6.053,29.268,4,24,4 C16.318,4,9.656,8.337,6.306,14.691z"></path>
                    <path fill="#4CAF50" d="M24,44
                        c5.166,0,9.86-1.977,13.409-5.192 l-6.19-5.238
                        C29.211,35.091,26.715,36,24,36
                        c-5.202,0-9.619-3.317-11.283-7.946 l-6.522,5.025
                        C9.505,39.556,16.227,44,24,44z"></path>
                    <path fill="#1976D2" d="M43.611,20.083 H42V20H24v8h11.303
                        c-0.792,2.237-2.231,4.166-4.087,5.571 l6.19,5.238
                        C36.971,39.205,44,34,44,24 C44,22.659,43.862,21.35,43.611,20.083z"></path>
                </svg>
                <span>Masuk dengan Google</span>
            </button>
        </div>
    </div>
    <!-- Toggle Password Script -->
    <script>
        const password = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        togglePassword.addEventListener('click', () => {
            const isPassword = password.type === 'password';
            password.type = isPassword ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', !isPassword);
            eyeClosed.classList.toggle('hidden', isPassword);
        });
    </script>
</body>

</html>
