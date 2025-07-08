@extends('layouts.landing')

@section('title', 'Kantin Kampus - Selamat Datang')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #fff3e0, #ffe0b2);
        color: #4e342e;
        font-family: 'Segoe UI', sans-serif;
    }

    .hero {
        text-align: center;
        margin-bottom: 60px;
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: bold;
        color: #bf360c;
    }

    .hero p {
        font-size: 1.2rem;
        color: #6d4c41;
    }

    .menu-section {
        margin-bottom: 60px;
    }

    .section-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 30px;
        color: #d84315;
        border-bottom: 2px solid #ffab91;
        display: inline-block;
    }

    .menu-card {
        border-radius: 15px;
        background-color: #ffffffcc;
        backdrop-filter: blur(6px);
        transition: all 0.3s ease;
        overflow: hidden;
        box-shadow: 0 6px 14px rgba(0,0,0,0.1);
    }

    .menu-card:hover {
        transform: translateY(-5px);
    }

    .menu-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .menu-body {
        padding: 15px;
    }

    .menu-body h5 {
        font-weight: bold;
        color: #4e342e;
    }

    .menu-body p {
        margin: 0;
        font-size: 0.95rem;
        color: #6d4c41;
    }

    .fade-in {
        animation: fadeInUp 0.7s ease forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<div class="hero">
    <h1>Selamat Datang di Kantin Kampus</h1>
    <p>Tempat terbaik untuk menikmati makanan lezat, minuman segar, dan camilan favorit!</p>
    <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg mt-3 shadow-sm">
        <i class="fas fa-sign-in-alt me-1"></i> Login Admin
    </a>
</div>

{{-- 🍛 Makanan --}}
<div class="menu-section">
    <h2 class="section-title">🍛 Menu Makanan</h2>
    <div class="row">
        @forelse($menus as $menu)
            <div class="col-md-4 mb-4 fade-in">
                <div class="menu-card">
                    <img src="{{ $menu->gambar ? asset('storage/' . $menu->gambar) : asset('img/default-food.jpg') }}"
                         class="menu-img" alt="{{ $menu->nama_menu }}">
                    <div class="menu-body text-center">
                        <h5>{{ $menu->nama_menu }}</h5>
                        <p>Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('landing.detail.makanan', $menu->id) }}" class="btn btn-outline-warning mt-2">Lihat Detail</a>
                        <a href="{{ route('landing.detail.makanan', $menu->id) }}?pesan=1" class="btn btn-warning mt-2 ms-2">
                            <i class="fas fa-shopping-cart me-1"></i> Pesan
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada menu makanan tersedia.</p>
        @endforelse
    </div>
</div>

{{-- 🥤 Minuman --}}
<div class="menu-section">
    <h2 class="section-title">🥤 Minuman Segar</h2>
    <div class="row">
        @forelse($minumans as $item)
            <div class="col-md-4 mb-4 fade-in">
                <div class="menu-card">
                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('img/default-drink.jpg') }}"
                         class="menu-img" alt="{{ $item->nama_minuman }}">
                    <div class="menu-body text-center">
                        <h5>{{ $item->nama_minuman }}</h5>
                        <p>Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('landing.detail.minuman', $item->id) }}" class="btn btn-outline-warning mt-2">Lihat Detail</a>
                        <a href="{{ route('landing.detail.minuman', $item->id) }}?pesan=1" class="btn btn-warning mt-2 ms-2">
                            <i class="fas fa-shopping-cart me-1"></i> Pesan
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada minuman tersedia.</p>
        @endforelse
    </div>
</div>

{{-- 🍪 Snack --}}
<div class="menu-section">
    <h2 class="section-title">🍪 Snack Ringan</h2>
    <div class="row">
        @forelse($snacks as $item)
            <div class="col-md-4 mb-4 fade-in">
                <div class="menu-card">
                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('img/default-snack.jpg') }}"
                         class="menu-img" alt="{{ $item->nama_snack }}">
                    <div class="menu-body text-center">
                        <h5>{{ $item->nama_snack }}</h5>
                        <p>Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('landing.detail.snack', $item->id) }}" class="btn btn-outline-warning mt-2">Lihat Detail</a>
                        <a href="{{ route('landing.detail.snack', $item->id) }}?pesan=1" class="btn btn-warning mt-2 ms-2">
                            <i class="fas fa-shopping-cart me-1"></i> Pesan
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada snack tersedia.</p>
        @endforelse
    </div>
</div>
@endsection
