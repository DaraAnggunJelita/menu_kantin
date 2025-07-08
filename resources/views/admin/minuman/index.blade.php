@extends('layouts.app')

@section('title', 'Data Minuman')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-warning mb-0 fw-bold">🥤 Data Minuman</h4>
        <a href="{{ route('admin.minuman.create') }}" class="btn btn-warning shadow">
            <i class="fas fa-plus me-1"></i> Tambah Minuman
        </a>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Data --}}
    @if ($minumans->count())
        <div class="row g-4">
            @foreach ($minumans as $m)
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0">

                        {{-- Gambar --}}
                        <div class="bg-warning-subtle d-flex align-items-center justify-content-center rounded-top" style="height: 160px;">
                            @if ($m->gambar)
                                <img src="{{ asset('storage/' . $m->gambar) }}"
                                     alt="Gambar Minuman"
                                     class="img-fluid p-2"
                                     style="max-height: 100%; max-width: 100%; object-fit: contain;">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </div>

                        {{-- Informasi --}}
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-semibold mb-1 text-dark">{{ $m->nama_minuman }}</h6>
                            <p class="text-muted mb-3">Rp {{ number_format($m->harga, 0, ',', '.') }}</p>

                            {{-- Tombol --}}
                            <div class="mt-auto d-flex justify-content-between gap-2">
                                <a href="{{ route('admin.minuman.edit', $m->id) }}" class="btn btn-outline-warning btn-sm w-100">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <a href="{{ route('admin.minuman.show', $m->id) }}" class="btn btn-outline-info btn-sm w-100">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </a>
                                <form action="{{ route('admin.minuman.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus minuman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm w-100">
                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning text-center">
            <i class="fas fa-info-circle me-1"></i> Belum ada data minuman.
        </div>
    @endif

</div>
@endsection
