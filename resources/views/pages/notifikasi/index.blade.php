@extends('layouts.master')

@section('title', 'Notifikasi')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"
        crossorigin="anonymous">
    <br><br><br>

    <div class="container mx-auto px-4 py-10" x-data="{ open: true }" x-cloak>
        <div class="max-w-3xl mx-auto space-y-6">

            {{-- HEADER --}}
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="bi bi-bell-fill text-green-600 text-2xl"></i>
                    Notifikasi
                </h1>

                @if (Auth::check())
                    @if ($notifications->total() > 0)
                        <button @click="open = !open"
                            class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 font-semibold text-gray-700 text-sm transition">
                            <i class="bi" :class="open ? 'bi-chevron-up' : 'bi-chevron-down'"></i>
                            <span class="ml-1 text-sm">Tampilkan</span>
                        </button>
                    @endif
                @endif
            </div>


            {{-- LIST NOTIF --}}
            @if (Auth::check())
                @if ($notifications->count() > 0)

                    <div x-show="open" x-transition.duration.400ms>

                        @foreach ($notifications as $notif)
                            <div x-data="{ read: {{ $notif->read_at ? 'true' : 'false' }} }"
                                class="border rounded-xl p-4 mb-4 bg-white shadow-sm hover:shadow transition">

                                <div class="flex justify-between items-start gap-3">

                                    {{-- ISI --}}
                                    <div class="flex-1">

                                        {{-- JUDUL / PESAN --}}
                                        <p class="text-base font-medium text-gray-800 mb-1"
                                            :class="!read ? 'font-semibold' : 'text-gray-600'">
                                            {{ $notif->data['message'] ?? ($notif->data['msg'] ?? ($notif->data['title'] ?? 'Notifikasi baru')) }}
                                        </p>

                                        {{-- WAKTU --}}
                                        <small class="text-gray-500 d-block">
                                            <i class="bi bi-clock"></i>
                                            {{ $notif->created_at->diffForHumans() }}
                                        </small>
                                    </div>


                                    {{-- ACTION BUTTONS --}}
                                    <div class="flex flex-col gap-2 items-end">

                                        {{-- TANDAI BACA --}}
                                        @if (!$notif->read_at)
                                            <button
                                                @click="
                                                read = true;
                                                fetch('{{ route('notifikasi.read', $notif->id) }}', {
                                                    method: 'POST',
                                                    headers: {
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                        'Content-Type': 'application/json'
                                                    }
                                                }).then(response => response.json()).then(data => {
                                                    if (data.success) {
                                                        console.log('Notifikasi ditandai baca');
                                                    }
                                                }).catch(error => console.error('Error:', error));
                                            "
                                                class="px-3 py-1 bg-green-500 text-white text-sm rounded-lg hover:bg-green-600 transition flex items-center gap-1">
                                                <i class="bi bi-check2-circle"></i> Baca
                                            </button>
                                        @endif

                                        {{-- LINK DETAIL JIKA ADA --}}
                                        @if (isset($notif->data['url']))
                                            <a href="{{ $notif->data['url'] }}"
                                                class="px-3 py-1 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition flex items-center gap-1">
                                                <i class="bi bi-box-arrow-up-right"></i> Lihat
                                            </a>
                                        @endif

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                    {{-- TANDAI SEMUA --}}
                    <div class="text-center mt-6">
                        <button
                            @click="
                            fetch('{{ route('notifikasi.readAll') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                }
                            }).then(response => response.json()).then(data => {
                                if (data.success) {
                                    console.log('Semua notifikasi ditandai baca');
                                    location.reload();
                                }
                            }).catch(error => console.error('Error:', error));
                        "
                            class="px-5 py-3 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 shadow transition">
                            <i class="bi bi-check2-all"></i> Tandai Semua Dibaca
                        </button>
                    </div>
                @else
                    {{-- JIKA TIDAK ADA NOTIF --}}
                    <div class="text-center py-12">
                        <i class="bi bi-bell-slash text-6xl text-gray-400 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700">Tidak ada notifikasi</h3>
                        <p class="text-gray-500">Belum ada notifikasi baru untuk Anda.</p>
                    </div>
                @endif
            @else
                {{-- BELUM LOGIN --}}
                <div class="text-center py-12">
                    <i class="bi bi-shield-lock text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700">Login Diperlukan</h3>
                    <p class="text-gray-500 mb-4">Anda harus login untuk melihat notifikasi.</p>
                    <a href="{{ route('login') }}"
                        class="px-5 py-3 bg-green-600 text-white rounded-lg text-sm font-semibold hover:bg-green-700 shadow transition">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </div>
            @endif

        </div>
    </div>

@endsection
