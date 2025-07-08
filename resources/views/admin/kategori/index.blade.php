@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-orange mb-0 fw-bold">📂 Data Kategori</h4>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-warning shadow">
            <i class="fas fa-plus me-1"></i> Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($kategoris->count())
        <div class="row g-4">
            @foreach ($kategoris as $k)
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 text-center bg-warning-subtle">

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <div class="mb-2 text-warning">
                                    <i class="fas fa-folder fa-3x"></i>
                                </div>
                                <h6 class="fw-bold text-dark">{{ $k->nama_kategori }}</h6>
                            </div>

                            <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST" class="mt-3"
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm w-100">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning text-center">
            <i class="fas fa-info-circle me-1"></i> Belum ada data kategori.
        </div>
    @endif

</div>
@endsection
