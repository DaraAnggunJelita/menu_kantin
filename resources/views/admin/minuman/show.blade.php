@extends('layouts.app')

@section('title', 'Detail Minuman')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h4 class="text-warning fw-bold">🧃 Detail Minuman</h4>
        <a href="{{ route('admin.dashboard.page', 'minuman') }}" class="btn btn-outline-secondary mt-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="row g-0">
            <div class="col-md-5">
                @if ($minuman->gambar)
                    <img src="{{ asset('storage/' . $minuman->gambar) }}" class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="Gambar Minuman">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center h-100 p-4">
                        <span class="text-muted">Tidak ada gambar</span>
                    </div>
                @endif
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $minuman->nama_minuman }}</h5>
                    <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($minuman->harga, 0, ',', '.') }}</p>

                    @if ($minuman->deskripsi)
                        <p class="card-text"><strong>Deskripsi:</strong> {{ $minuman->deskripsi }}</p>
                    @else
                        <p class="card-text text-muted">Tidak ada deskripsi.</p>
                    @endif

                    <p class="card-text"><small class="text-muted">ID: {{ $minuman->id }}</small></p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
