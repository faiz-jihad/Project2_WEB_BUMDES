<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Pilih Dashboard
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Selamat datang! Pilih tujuan Anda:
                </p>
            </div>

            <div class="space-y-4">
                <!-- Admin/Filament Dashboard -->
                <form method="POST" action="{{ route('dashboard.admin') }}">
                    @csrf
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 1L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-6zM5 9a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm0 4a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        Panel Admin (Filament)
                    </button>
                </form>

                <!-- Home/Dashboard -->
                <form method="POST" action="{{ route('dashboard.home') }}">
                    @csrf
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-500 group-hover:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-6 6A1 1 0 004 9v8a1 1 0 001 1h2a1 1 0 001-1v-3a1 1 0 011-1h2a1 1 0 011 1v3a1 1 0 001 1h2a1 1 0 001-1V9a1 1 0 00-.293-.707l-6-6z" />
                            </svg>
                        </span>
                        Beranda Website
                    </button>
                </form>
            </div>

            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline">
                        Keluar dari akun
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
