@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="text-primary">Tambah Minuman</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.minuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_minuman" class="form-label">Nama Minuman</label>
                    <input type="text" name="nama_minuman" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.dashboard.page', 'minuman') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
