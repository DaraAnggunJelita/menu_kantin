@extends('layouts.app')
@section('title', 'Edit Minuman')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="text-primary">Edit Minuman</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.minuman.update', $minuman->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_minuman" class="form-label">Nama Minuman</label>
                    <input type="text" name="nama_minuman" class="form-control" value="{{ $minuman->nama_minuman }}" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" value="{{ $minuman->harga }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ $minuman->deskripsi }}</textarea>
                </div>

                {{-- ✅ Tambahkan Kategori --}}
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id }}" {{ $minuman->kategori_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    @if ($minuman->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $minuman->gambar) }}" alt="Gambar Minuman" width="100" class="img-thumbnail">
                        </div>
                    @endif
                    <input type="file" name="gambar" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.dashboard.page', 'minuman') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
