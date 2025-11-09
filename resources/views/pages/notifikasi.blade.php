@extends('layouts.master')

@section('title', 'Notifikasi')

@section('content')
<br><br><br>
    <div class="container mx-auto px-4 py-10" x-data="{ notificationsOpen: true }" x-cloak>
        <div class="max-w-4xl mx-auto space-y-6">
            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-3">
                    <i class="bi bi-bell-fill text-green-600 text-3xl animate-pulse"></i>
                    Notifikasi
                </h1>

                @if (Auth::check())
                    @php
                        $user = Auth::user();
                        $penulis = \App\Models\Penulis::where('Username', $user->email)->first();
                        $notificationCount = $penulis
                            ? $penulis->notifications->count()
                            : $user->notifications->count();
                    @endphp
                    @if ($notificationCount > 0)
                        <button @click="notificationsOpen = !notificationsOpen"
                            class="flex items-center bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 px-4 py-2 rounded-xl text-gray-700 dark:text-gray-200 font-semibold transition duration-200">
                            <i class="bi" :class="notificationsOpen ? 'bi-chevron-up' : 'bi-chevron-down'"></i>
                            <span class="ml-2">Tampilkan</span>
                        </button>
                    @endif
                @endif
            </div>

            @if (Auth::check())
                @php
                    $user = Auth::user();
                    $penulis = \App\Models\Penulis::where('Username', $user->email)->first();
                    $notifications = $penulis ? $penulis->notifications : $user->notifications;
                @endphp
                @if ($notifications->count() > 0)
                    <div x-show="notificationsOpen" x-transition.duration.500ms class="space-y-4">
                        @foreach ($notifications as $notification)
                            <div x-data="{ read: {{ $notification->read_at ? 'true' : 'false' }} }"
                                class="relative overflow-hidden rounded-2xl border-l-4 transition transform hover:-translate-y-1 duration-300 shadow-md hover:shadow-lg
                                    bg-white dark:bg-gray-800"
                                :class="read ? 'border-gray-400' : 'border-green-500'">

                                <!-- highlight animation -->
                                <div x-show="!read"
                                    class="absolute inset-0 bg-green-50 dark:bg-green-900/30 animate-pulse opacity-40">
                                </div>

                                <div class="relative p-6 flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="text-lg font-medium text-gray-800 dark:text-gray-100 mb-1">
                                            {{ $notification->data['message'] ?? 'Notifikasi baru' }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                            <i class="bi bi-clock"></i>
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </div>

                                    <div class="flex space-x-2">
                                        @if (!$notification->read_at)
                                            <button
                                                @click="
                                                read = true;
                                                fetch('{{ route('notifikasi.read', $notification->id) }}')
                                            "
                                                class="flex items-center bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-200">
                                                <i class="bi bi-check2-circle mr-1"></i> Tandai Dibaca
                                            </button>
                                        @endif

                                        @if (isset($notification->data['url']))
                                            <a href="{{ $notification->data['url'] }}"
                                                class="flex items-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-200">
                                                <i class="bi bi-box-arrow-up-right mr-1"></i> Lihat Detail
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10 text-center">
                        <a href="{{ route('notifikasi.readAll') }}"
                            class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold shadow transition transform hover:scale-105 duration-200">
                            <i class="bi bi-check2-all mr-2"></i> Tandai Semua Dibaca
                        </a>
                    </div>
                @else
                    <div class="text-center py-16 animate-fadeIn">
                        <div class="text-gray-400 mb-5">
                            <i class="bi bi-bell-slash text-7xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 mb-2">Tidak ada notifikasi</h3>
                        <p class="text-gray-500 dark:text-gray-400">Anda belum memiliki notifikasi apapun.</p>
                    </div>
                @endif
            @else
                <div class="text-center py-16 animate-fadeIn">
                    <div class="text-gray-400 mb-5">
                        <i class="bi bi-shield-lock text-7xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 mb-2">Login Diperlukan</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Silakan login untuk melihat notifikasi Anda.</p>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold shadow transition transform hover:scale-105 duration-200">
                        <i class="bi bi-box-arrow-in-right mr-2"></i> Login
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
