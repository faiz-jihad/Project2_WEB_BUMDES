<x-filament-widgets::widget>
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-base font-semibold text-gray-900">Notifikasi</h3>
            <div class="flex items-center space-x-2">
                @if ($this->getTotalNotifications() > 0)
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        {{ $this->getTotalNotifications() }}
                    </span>
                @endif
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-5 5v-5zM4.868 12.683A17.925 17.925 0 0112 21c7.962 0 12-1.21 12-2.683m-12 2.683a17.925 17.925 0 01-7.132-8.317M12 21V9m0 0a3 3 0 00-3-3m3 3a3 3 0 003-3m-3 3V3">
                    </path>
                </svg>
            </div>
        </div>

        <div class="space-y-2">
            <!-- Berita Pending -->
            <div class="flex items-center justify-between p-2 bg-blue-50 rounded-md">
                <div class="flex items-center space-x-2">
                    <div class="flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-medium text-blue-900 truncate">Berita Pending</p>
                        <p class="text-xs text-blue-600 truncate">Perlu review</p>
                    </div>
                </div>
                @if ($this->getPendingBeritaCount() > 0)
                    <span
                        class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $this->getPendingBeritaCount() }}
                    </span>
                @endif
            </div>

            <!-- Pesanan Baru -->
            <div class="flex items-center justify-between p-2 bg-green-50 rounded-md">
                <div class="flex items-center space-x-2">
                    <div class="flex-shrink-0">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-medium text-green-900 truncate">Pesanan Baru</p>
                        <p class="text-xs text-green-600 truncate">Perlu proses</p>
                    </div>
                </div>
                @if ($this->getNewOrdersCount() > 0)
                    <span
                        class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        {{ $this->getNewOrdersCount() }}
                    </span>
                @endif
            </div>
        </div>

        <div class="mt-3 pt-3 border-t border-gray-200">
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('filament.admin.resources.beritas.index') }}"
                    class="inline-flex justify-center items-center px-2 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-blue-500 transition-colors">
                    Berita
                </a>
                <a href="{{ route('filament.admin.resources.pesanans.index') }}"
                    class="inline-flex justify-center items-center px-2 py-1.5 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-green-500 transition-colors">
                    Pesanan
                </a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
