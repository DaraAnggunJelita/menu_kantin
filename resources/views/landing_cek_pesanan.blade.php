@extends('layouts.landing')

@section('title', 'Cek Status Pesanan')

@section('content')
<div class="container py-5">
    <h3 class="text-center mb-4 text-danger">🔍 Cek Status Pesanan</h3>

    {{-- 🔍 Form Pencarian --}}
    <form method="GET" action="{{ route('cek.pesanan.form') }}" class="mb-4">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-2">
                <input type="text" name="nama_pemesan" class="form-control" placeholder="Nama Pemesan" required value="{{ request('nama_pemesan') }}">
            </div>
            <div class="col-md-4 mb-2">
                <input type="text" name="no_hp" class="form-control" placeholder="No HP" required value="{{ request('no_hp') }}">
            </div>
            <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-search me-1"></i> Cek
                </button>
            </div>
        </div>
    </form>

    {{-- 📦 Hasil Pencarian --}}
    @if(request()->filled('nama_pemesan') && request()->filled('no_hp'))
        @if($pemesanans->count())
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-warning">
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Waktu Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesanans as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($p->menu)
                                        🍽️ {{ $p->menu->nama_menu }}
                                    @elseif ($p->minuman)
                                        🧃 {{ $p->minuman->nama_minuman }}
                                    @elseif ($p->snack)
                                        🍪 {{ $p->snack->nama_snack }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $p->jumlah }}</td>
                                <td>
                                    @if ($p->status == 'pending')
                                        <span class="badge bg-secondary">Pending</span>
                                    @elseif ($p->status == 'diproses')
                                        <span class="badge bg-warning text-dark">Diproses</span>
                                    @elseif ($p->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif ($p->status == 'dibatalkan')
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>{{ $p->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning text-center">
                ❌ Tidak ditemukan pesanan untuk nama dan no HP tersebut.
            </div>
        @endif

        {{-- 🔙 Tombol kembali --}}
        <div class="text-center mt-4">
            <a href="{{ route('landing') }}" class="btn btn-outline-danger">
                <i class="fas fa-home me-1"></i> Kembali ke Beranda
            </a>
        </div>
    @endif
</div>
@endsection
