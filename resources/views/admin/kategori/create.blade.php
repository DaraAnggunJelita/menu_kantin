@extends('layouts.app')
@section('title', 'Tambah Kategori')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="text-primary">Tambah Kategori</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.dashboard.page', 'kategori') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
