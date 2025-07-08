@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Edit Menu Makanan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_menu" class="form-label">Nama Menu</label>
                    <input type="text" id="nama_menu" name="nama_menu" class="form-control @error('nama_menu') is-invalid @enderror" value="{{ old('nama_menu', $menu->nama_menu) }}" required>
                    @error('nama_menu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select id="kategori_id" name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id', $menu->kategori_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', $menu->harga) }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" id="gambar" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($menu->gambar)
                        <img src="{{ asset('storage/' . $menu->gambar) }}" class="img-thumbnail mt-2" style="width: 100px" alt="Gambar {{ $menu->nama_menu }}">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
