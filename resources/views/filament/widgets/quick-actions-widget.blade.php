<x-filament-widgets::widget>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ route('filament.admin.resources.beritas.create') }}" target="_blank"
            class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg border border-green-200 transition-colors">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">Buat Berita Baru</p>
                <p class="text-xs text-green-600">Tambah artikel berita</p>
            </div>
        </a>

        <a href="{{ route('filament.admin.resources.produks.create') }}" target="_blank"
            class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200 transition-colors">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-blue-800">Tambah Produk</p>
                <p class="text-xs text-blue-600">Tambah produk baru</p>
            </div>
        </a>

        <a href="{{ route('filament.admin.resources.pesanans.index') }}" target="_blank"
            class="flex items-center p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg border border-yellow-200 transition-colors">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-yellow-800">Lihat Pesanan</p>
                <p class="text-xs text-yellow-600">Kelola pesanan pelanggan</p>
            </div>
        </a>

        <a href="{{ route('filament.admin.resources.users.index') }}" target="_blank"
            class="flex items-center p-4 bg-cyan-50 hover:bg-cyan-100 rounded-lg border border-cyan-200 transition-colors">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                    </path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-cyan-800">Kelola Pengguna</p>
                <p class="text-xs text-cyan-600">Kelola data pengguna</p>
            </div>
        </a>

        <a href="{{ route('filament.admin.resources.galeris.index') }}" target="_blank"
            class="flex items-center p-4 bg-gray-50 hover:bg-gray-100 rounded-lg border border-gray-200 transition-colors">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-800">Kelola Galeri</p>
                <p class="text-xs text-gray-600">Kelola galeri foto</p>
            </div>
        </a>

        <a href="{{ route('filament.admin.resources.banners.index') }}" target="_blank"
            class="flex items-center p-4 bg-red-50 hover:bg-red-100 rounded-lg border border-red-200 transition-colors">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-red-800">Kelola Banner</p>
                <p class="text-xs text-red-600">Kelola banner website</p>
            </div>
        </a>
    </div>
</x-filament-widgets::widget>
