@extends('layouts.app')

@section('title', 'Detail Snack')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h4 class="text-primary fw-bold">🍪 Detail Snack</h4>
        <a href="{{ route('admin.dashboard.page', 'snack') }}" class="btn btn-outline-secondary mt-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="row g-0">
            <div class="col-md-5">
                @if ($snack->gambar)
                    <img src="{{ asset('storage/' . $snack->gambar) }}" class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="Gambar Snack">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center h-100 p-4">
                        <span class="text-muted">Tidak ada gambar</span>
                    </div>
                @endif
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $snack->nama_snack }}</h5>
                    <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($snack->harga, 0, ',', '.') }}</p>

                    @if ($snack->deskripsi)
                        <p class="card-text"><strong>Deskripsi:</strong> {{ $snack->deskripsi }}</p>
                    @else
                        <p class="card-text text-muted">Tidak ada deskripsi.</p>
                    @endif

                    <p class="card-text"><small class="text-muted">ID: {{ $snack->id }}</small></p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
