@extends('layouts.landing')

@section('title', 'Detail Menu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                @if ($menu->gambar)
                    <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top" alt="Gambar {{ $menu->nama_menu ?? $menu->nama_minuman ?? $menu->nama_snack }}">
                @else
                    <img src="{{ asset('img/default-food.jpg') }}" class="card-img-top" alt="Gambar Default">
                @endif

                <div class="card-body text-center">
                    <h4 class="card-title">{{ $menu->nama_menu ?? $menu->nama_minuman ?? $menu->nama_snack }}</h4>
                    <p class="text-muted">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                    @if (!empty($menu->deskripsi))
                        <p class="mt-3">{{ $menu->deskripsi }}</p>
                    @endif
                    <a href="{{ route('landing') }}" class="btn btn-outline-secondary mt-3">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
