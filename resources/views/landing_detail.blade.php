@extends('layouts.landing')

@section('title', 'Detail Menu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            {{-- Kartu Detail Menu --}}
            <div class="card shadow">
                @if ($menu->gambar)
                    <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top"
                         alt="Gambar {{ $menu->nama_menu ?? $menu->nama_minuman ?? $menu->nama_snack }}">
                @else
                    <img src="{{ asset('img/default-food.jpg') }}" class="card-img-top" alt="Gambar Default">
                @endif

                <div class="card-body text-center">
                    <h4 class="card-title">{{ $menu->nama_menu ?? $menu->nama_minuman ?? $menu->nama_snack }}</h4>
                    <p class="text-muted">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>

                    @if (!empty($menu->deskripsi))
                        <p class="mt-3">{{ $menu->deskripsi }}</p>
                    @endif

                    <a href="{{ route('landing') }}" class="btn btn-outline-warning mt-3">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>

            {{-- ✅ FORM PEMESANAN --}}
            <div class="card mt-4 shadow" id="form-pesan">
                <div class="card-header bg-warning text-white text-center fw-bold">
                    Form Pemesanan
                </div>
                <div class="card-body">

                    {{-- 🔔 Notifikasi sukses atau error --}}
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('pesan.store') }}" method="POST">
                        @csrf

                        {{-- input hidden untuk tipe dan id --}}
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $menu->id }}">

                        <div class="mb-3">
                            <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" value="{{ old('nama_pemesan') }}"
                                   class="form-control @error('nama_pemesan') is-invalid @enderror" required>
                            @error('nama_pemesan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                                   class="form-control @error('no_hp') is-invalid @enderror" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Pesanan</label>
                            <input type="number" name="jumlah" min="1" value="{{ old('jumlah', 1) }}"
                                   class="form-control @error('jumlah') is-invalid @enderror" required>
                            @error('jumlah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-paper-plane me-1"></i> Kirim Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
