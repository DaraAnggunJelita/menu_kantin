@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Tambah Snack</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.snack.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama_snack" class="form-label">Nama Snack</label>
                    <input type="text" name="nama_snack" class="form-control @error('nama_snack') is-invalid @enderror" value="{{ old('nama_snack') }}" required>
                    @error('nama_snack')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.dashboard.page', 'snack') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
