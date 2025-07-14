@extends('layouts.landing')

@section('title', 'Kantin Kampus - Selamat Datang')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #fffde7, #fff3e0);
        font-family: 'Poppins', sans-serif;
        color: #4e342e;
    }

    .hero {
        text-align: center;
        padding: 80px 20px;
        background: linear-gradient(135deg, #ffe0b2, #ffccbc);
        border-radius: 20px;
        margin-bottom: 50px;
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #bf360c;
    }

    .hero p {
        font-size: 1.2rem;
        color: #6d4c41;
    }

    .section-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 30px;
        color: #d84315;
        border-left: 6px solid #ff8a65;
        padding-left: 15px;
    }

    .menu-card {
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: 0.3s ease-in-out;
    }

    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.12);
    }

    .menu-img {
        height: 180px;
        width: 100%;
        object-fit: cover;
    }

    .menu-body {
        padding: 15px;
    }

    .menu-body h5 {
        font-weight: bold;
        font-size: 1.1rem;
    }

    .price {
        color: #bf360c;
        font-weight: 600;
    }

    .btn-action {
        font-size: 0.9rem;
        margin: 5px;
    }

    .fade-in {
        animation: fadeInUp 0.6s ease both;
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

{{-- HERO --}}
<div class="hero shadow fade-in">
    <h1>Selamat Datang di <span style="color:#d84315;">Kantin Kampus</span></h1>
    <p class="mt-3">Nikmati makanan lezat, minuman segar, dan snack favorit mahasiswa!</p>
    <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg mt-3 shadow-sm">
        <i class="fas fa-sign-in-alt me-1"></i> Login Admin
    </a>
    <a href="{{ route('cek.pesanan.form') }}" class="btn btn-success btn-lg mt-3 shadow-sm ms-2">
        <i class="fas fa-search me-1"></i> Cek Status Pesanan
    </a>
</div>

{{-- 🍽️ MENU MAKANAN --}}
<div class="menu-section mb-5">
    <h2 class="section-title">🍛 Menu Makanan</h2>
    <div class="row">
        @forelse($menus as $menu)
        <div class="col-md-4 mb-4 fade-in">
            <div class="menu-card">
                <img src="{{ $menu->gambar ? asset('storage/' . $menu->gambar) : asset('img/default-food.jpg') }}"
                     class="menu-img" alt="{{ $menu->nama_menu }}">
                <div class="menu-body text-center">
                    <h5>{{ $menu->nama_menu }}</h5>
                    <p class="price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                    <a href="{{ route('landing.detail.makanan', $menu->id) }}" class="btn btn-outline-warning btn-action">Detail</a>
                    <a href="{{ route('landing.detail.makanan', $menu->id) }}?pesan=1" class="btn btn-warning btn-action">
                        <i class="fas fa-cart-plus me-1"></i> Pesan
                    </a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">Belum ada menu makanan tersedia.</p>
        @endforelse
    </div>
</div>

{{-- 🧃 MINUMAN --}}
<div class="menu-section mb-5">
    <h2 class="section-title">🥤 Minuman Segar</h2>
    <div class="row">
        @forelse($minumans as $item)
        <div class="col-md-4 mb-4 fade-in">
            <div class="menu-card">
                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('img/default-drink.jpg') }}"
                     class="menu-img" alt="{{ $item->nama_minuman }}">
                <div class="menu-body text-center">
                    <h5>{{ $item->nama_minuman }}</h5>
                    <p class="price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    <a href="{{ route('landing.detail.minuman', $item->id) }}" class="btn btn-outline-warning btn-action">Detail</a>
                    <a href="{{ route('landing.detail.minuman', $item->id) }}?pesan=1" class="btn btn-warning btn-action">
                        <i class="fas fa-cart-plus me-1"></i> Pesan
                    </a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">Belum ada minuman tersedia.</p>
        @endforelse
    </div>
</div>

{{-- 🍪 SNACK --}}
<div class="menu-section mb-5">
    <h2 class="section-title">🍪 Snack Ringan</h2>
    <div class="row">
        @forelse($snacks as $item)
        <div class="col-md-4 mb-4 fade-in">
            <div class="menu-card">
                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('img/default-snack.jpg') }}"
                     class="menu-img" alt="{{ $item->nama_snack }}">
                <div class="menu-body text-center">
                    <h5>{{ $item->nama_snack }}</h5>
                    <p class="price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    <a href="{{ route('landing.detail.snack', $item->id) }}" class="btn btn-outline-warning btn-action">Detail</a>
                    <a href="{{ route('landing.detail.snack', $item->id) }}?pesan=1" class="btn btn-warning btn-action">
                        <i class="fas fa-cart-plus me-1"></i> Pesan
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
