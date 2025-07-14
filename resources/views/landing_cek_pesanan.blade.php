@extends('layouts.landing')

@section('title', 'Cek Status Pesanan')

@section('content')
    <div class="container py-5">
        <h3 class="text-center mb-4 text-danger fw-bold">🔍 Cek Status Pesanan</h3>

        {{-- 🔍 Form Pencarian --}}
        <form method="GET" action="{{ route('cek.pesanan.form') }}" class="mb-5">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-2">
                    <input type="text" name="nama_pemesan" class="form-control border border-orange shadow-sm"
                        placeholder="Nama Pemesan" required value="{{ request('nama_pemesan') }}">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" name="no_hp" class="form-control border border-orange shadow-sm"
                        placeholder="No HP" required value="{{ request('no_hp') }}">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="submit" class="btn btn-orange w-100 fw-semibold shadow-sm">
                        <i class="fas fa-search me-1"></i> Cek
                    </button>
                </div>
            </div>
        </form>

        {{-- 📦 Hasil Pencarian --}}
        @if (request()->filled('nama_pemesan') && request()->filled('no_hp'))
            @if ($pemesanans->count())
                <div class="table-responsive">
                    <table class="table table-bordered align-middle shadow-sm">
                        <thead style="background-color: #ffe0b2;" class="text-center text-dark">
                            <tr>
                                <th>No</th>
                                <th>Item</th>
                                <th>Jumlah</th>
                                <th>Nama Pemesan</th>
                                <th>No HP</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanans as $p)
                                <tr class="text-center">
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
                                    <td>{{ $p->nama_pemesan }}</td>
                                    <td>{{ $p->no_hp }}</td>
                                    <td>
                                        @if ($p->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($p->status == 'diproses')
                                            <span class="badge bg-primary">Diproses</span>
                                        @elseif ($p->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif ($p->status == 'dibatalkan')
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Diketahui</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center">
                    ❌ Data pesanan tidak ditemukan.
                </div>
            @endif
        @endif

        {{-- 🔙 Tombol Kembali ke Beranda --}}
        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="btn btn-secondary shadow-sm">
                ⬅️ Kembali ke Beranda
            </a>
        </div>

        {{-- Tambahan style custom untuk warna tema --}}
        <style>
            .border-orange {
                border-color: #d84315 !important;
            }

            .btn-orange {
                background-color: #d84315;
                color: white;
            }

            .btn-orange:hover {
                background-color: #bf360c;
                color: white;
            }

            .btn-danger {
                background-color: #d84315;
                border-color: #d84315;
            }

            .btn-danger:hover {
                background-color: #bf360c;
                border-color: #bf360c;
            }

            .form-select:focus {
                border-color: #d84315;
                box-shadow: 0 0 0 0.2rem rgba(216, 67, 21, 0.25);
            }
        </style>
    </div>
@endsection
