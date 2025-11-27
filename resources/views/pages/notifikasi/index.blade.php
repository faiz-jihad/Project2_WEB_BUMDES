@extends('layouts.master')

@section('title', 'Notifikasi')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        font-family: "Poppins", sans-serif;
        background: #eef2f6;
    }

    .notif-container {
        max-width: 800px;
        margin: 70px auto;
        padding: 0 20px;
    }

    /* HEADER */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-icon {
        width: 55px;
        height: 55px;
        background: linear-gradient(135deg, #0ea5e9, #0284c7);
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 26px;
    }

    /* ICONS RIGHT */
    .right-icons {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: white;
        border: 1px solid #d7dfe7;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: .2s;
        font-size: 20px;
        color: #475569;
    }

    .icon-box:hover {
        background: #e4eaef;
    }

    /* Toggle Button */
    .toggle-btn {
        padding: 10px 14px;
        background: white;
        border: 1px solid #d5dde5;
        border-radius: 10px;
        font-size: 14px;
        cursor: pointer;
        transition: 0.2s;
    }
    .toggle-btn:hover {
        background: #dbe4ea;
    }

    /* NOTIF CARD */
    .notif-card {
        background: white;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 18px;
        border: 1px solid #dbe4ea;
        box-shadow: 0 3px 8px rgba(0,0,0,0.06);
        transition: 0.25s ease;
    }
    .notif-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.08);
    }

    .notif-card.unread {
        border-left: 6px solid #0ea5e9;
    }

    .notif-title {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 6px;
    }
    .notif-title.read {
        font-weight: 500;
        color: #64748b;
    }

    .notif-time {
        font-size: 13px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .actions {
        margin-top: 15px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    /* BUTTONS */
    .btn-read {
        background: #0ea5e9;
        padding: 9px 14px;
        border: none;
        color: white;
        border-radius: 8px;
        font-size: 13px;
        cursor: pointer;
        transition: .2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .btn-read:hover {
        background: #0284c7;
    }

    .btn-view {
        background: #10b981;
        padding: 9px 14px;
        border: none;
        color: white !important;
        border-radius: 8px;
        font-size: 13px;
        cursor: pointer;
        text-decoration: none;
        transition: .2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .btn-view:hover {
        background: #0f9d71;
    }

    .mark-all-btn {
        width: 100%;
        padding: 12px;
        background: #0ea5e9;
        border: none;
        color: white;
        font-weight: 600;
        margin-top: 30px;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.2s;
        box-shadow: 0 4px 12px rgba(14,165,233,0.3);
    }
    .mark-all-btn:hover {
        background: #0284c7;
    }

    .hidden { display: none; }

    /* RESPONSIVE */
    @media (max-width: 600px) {
        .header {
            text-align: center;
            justify-content: center;
        }
        .right-icons {
            justify-content: center;
            width: 100%;
        }
    }
</style>

<div class="notif-container">

    {{-- HEADER --}}
    <div class="header">
        <div class="header-title">
            <div class="header-icon">
                <i class="bi bi-bell-fill"></i>
            </div>
            <div>
                <h2 style="margin:0;">Notifikasi</h2>
                <p style="margin:2px 0 0; font-size:14px; color:#64748b;">
                    Pemberitahuan terbaru untuk Anda
                </p>
            </div>
        </div>

        {{-- ICON PESANAN DAN BEL --}}
        <div class="right-icons">
            <a href="{{ route('pesanan.index') }}" class="icon-box" title="Pesanan Saya">
                <i class="bi bi-bag-fill"></i>
            </a>

            <a href="{{ route('notifikasi.index') }}" class="icon-box" title="Notifikasi">
                <i class="bi bi-bell"></i>
            </a>

            @if(Auth::check() && $notifications->total() > 0)
                <button class="toggle-btn" onclick="toggleList()">
                    <i id="toggleIcon" class="bi bi-chevron-up"></i>
                </button>
            @endif
        </div>
    </div>

    {{-- LIST NOTIFIKASI --}}
    @if(Auth::check())

        @if($notifications->count() > 0)

        <div id="notifList">
            @foreach($notifications as $notif)

            <div class="notif-card {{ $notif->read_at ? '' : 'unread' }}" id="notif-{{ $notif->id }}">

                <div class="notif-title {{ $notif->read_at ? 'read' : '' }}">
                    {{ $notif->data['message'] ?? $notif->data['title'] ?? 'Notifikasi baru' }}
                </div>

                <div class="notif-time">
                    <i class="bi bi-clock"></i> {{ $notif->created_at->diffForHumans() }}
                </div>

                <div class="actions">
                    @if(!$notif->read_at)
                    <button class="btn-read" onclick="markRead({{ $notif->id }})">
                        <i class="bi bi-check2-circle"></i> Tandai Baca
                    </button>
                    @endif

                    @if(isset($notif->data['url']))
                    <a href="{{ $notif->data['url'] }}" class="btn-view">
                        <i class="bi bi-box-arrow-up-right"></i> Lihat
                    </a>
                    @endif
                </div>

            </div>

            @endforeach
        </div>

        <button class="mark-all-btn" onclick="markAll()">
            <i class="bi bi-check2-all"></i> Tandai Semua Dibaca
        </button>

        @else

        {{-- KOSONG --}}
        <div style="text-align:center; padding:60px 0;">
            <i class="bi bi-bell-slash" style="font-size:70px; color:#94a3b8;"></i>
            <h3 style="margin-top:10px;">Tidak ada notifikasi</h3>
            <p style="color:#64748b;">Belum ada pemberitahuan.</p>
        </div>

        @endif

    @else

    {{-- BELUM LOGIN --}}
    <div style="text-align:center; padding:60px 0;">
        <i class="bi bi-shield-lock" style="font-size:70px; color:#94a3b8;"></i>
        <h3 style="margin-top:10px;">Login diperlukan</h3>
        <p style="color:#64748b;">Silakan masuk untuk melihat notifikasi Anda.</p>

        <a href="{{ route('login') }}" style="
            padding:12px 20px; background:#0ea5e9; color:white;
            text-decoration:none; border-radius:10px; font-weight:600;">
            <i class="bi bi-box-arrow-in-right"></i> Login
        </a>
    </div>

    @endif

</div>

<script>
    function toggleList() {
        const list = document.getElementById("notifList");
        const icon = document.getElementById("toggleIcon");

        list.classList.toggle("hidden");
        icon.classList.toggle("bi-chevron-down");
        icon.classList.toggle("bi-chevron-up");
    }

    function markRead(id) {
        fetch('{{ url("notifikasi/read") }}/' + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
        .then(r => r.json())
        .then(d => {
            if(d.success){
                const card = document.getElementById("notif-" + id);
                card.classList.remove("unread");
                card.querySelector(".notif-title").classList.add("read");

                const btn = card.querySelector(".btn-read");
                if(btn) btn.remove();
            }
        });
    }

    function markAll() {
        fetch('{{ route("notifikasi.readAll") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(r => r.json())
        .then(d => {
            if(d.success){
                document.querySelectorAll(".notif-card").forEach(card => {
                    card.classList.remove("unread");
                    const title = card.querySelector(".notif-title");
                    if(title) title.classList.add("read");
                    const btn = card.querySelector(".btn-read");
                    if(btn) btn.remove();
                });
            }
        });
    }
</script>

@endsection
