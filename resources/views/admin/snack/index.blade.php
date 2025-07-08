@extends('layouts.app')

@section('title', 'Data Snack')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-warning mb-0 fw-bold">🍪 Data Snack</h4>
        <a href="{{ route('admin.snack.create') }}" class="btn btn-warning shadow">
            <i class="fas fa-plus me-1"></i> Tambah Snack
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tampilkan daftar snack --}}
    @if ($snacks->count())
        <div class="row g-4">
            @foreach ($snacks as $s)
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0">

                        {{-- Gambar Snack --}}
                        <div class="bg-warning-subtle d-flex align-items-center justify-content-center rounded-top" style="height: 160px;">
                            @if ($s->gambar)
                                <img src="{{ asset('storage/' . $s->gambar) }}"
                                     alt="Gambar Snack"
                                     class="img-fluid p-2"
                                     style="max-height: 100%; max-width: 100%; object-fit: contain;">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </div>

                        {{-- Konten --}}
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-semibold mb-1 text-dark">{{ $s->nama_snack }}</h6>
                            <p class="text-muted mb-3">Rp {{ number_format($s->harga, 0, ',', '.') }}</p>

                            {{-- Tombol --}}
                            <div class="mt-auto d-flex justify-content-between gap-2">
                                <a href="{{ route('admin.snack.show', $s->id) }}" class="btn btn-outline-info btn-sm w-100">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </a>
                                <a href="{{ route('admin.snack.edit', $s->id) }}" class="btn btn-outline-warning btn-sm w-100">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.snack.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus snack ini?')" class="w-100">
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
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-1"></i> Belum ada data snack.
        </div>
    @endif

</div>
@endsection
