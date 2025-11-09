@extends('layouts.master')

@section('title', 'Notifikasi')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Notifikasi</h1>

            @if (Auth::check())
                @if ($notifications->count() > 0)
                    <div class="space-y-4">
                        @foreach ($notifications as $notification)
                            <div
                                class="bg-white rounded-lg shadow-md p-6 {{ $notification->read_at ? 'border-l-4 border-gray-300' : 'border-l-4 border-green-500 bg-green-50' }}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="text-gray-800 mb-2">
                                            {{ $notification->data['message'] ?? 'Notifikasi baru' }}</p>
                                        <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        @if (!$notification->read_at)
                                            <a href="{{ route('notifikasi.read', $notification->id) }}"
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                                Tandai Dibaca
                                            </a>
                                        @endif
                                        @if (isset($notification->data['url']))
                                            <a href="{{ $notification->data['url'] }}"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                                Lihat Detail
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('notifikasi.readAll') }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-200">
                            Tandai Semua Dibaca
                        </a>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $notifications->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-gray-400 mb-4">
                            <i class="bi bi-bell-slash text-6xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada notifikasi</h3>
                        <p class="text-gray-500">Anda belum memiliki notifikasi apapun.</p>
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <i class="bi bi-shield-lock text-6xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Login Diperlukan</h3>
                    <p class="text-gray-500 mb-6">Silakan login untuk melihat notifikasi Anda.</p>
                    <a href="{{ route('login') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-200">
                        Login
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof window.Echo !== 'undefined') {
                window.Echo.private('notifications.{{ Auth::id() }}')
                    .listen('.notification.sent', (e) => {
                        // Reload the page to show new notification
                        location.reload();
                    });
            }
        });
    </script>
@endsection
