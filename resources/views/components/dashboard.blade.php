@props(['title', 'value', 'icon', 'color'])

<div class="card stats-card shadow-sm border-0 rounded-4 text-center p-4 bg-gradient"
    style="background:linear-gradient(135deg,{{ $color }},{{ $color }}aa);color:white;">
    <i class="bi {{ $icon }} fs-2 mb-2"></i>
    <h3 class="fw-bold mb-0">{{ $value }}</h3>
    <p class="mb-0">{{ $title }}</p>
</div>

<style>
    .stats-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .bg-gradient {
        position: relative;
        overflow: hidden;
    }

    .bg-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        pointer-events: none;
    }
</style>
