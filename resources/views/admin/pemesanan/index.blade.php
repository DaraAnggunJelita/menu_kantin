@extends('layouts.app')

@section('title', 'Data Pemesanan')

@section('content')
<div class="container py-4">
    <h4 class="mb-4 fw-bold text-warning">📦 Data Pemesanan</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($pemesanans->count())
        <div class="table-responsive">
            <table class="table table-bordered align-middle shadow-sm">
                <thead style="background-color: #ffe0b2;" class="text-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Jumlah</th>
                        <th>Nama Pemesan</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanans as $p)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($p->menu)
                                    🍽️ {{ $p->menu->nama_menu }}
                                @elseif($p->minuman)
                                    🧃 {{ $p->minuman->nama_minuman }}
                                @elseif($p->snack)
                                    🍪 {{ $p->snack->nama_snack }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ $p->nama_pemesan }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td>
                                <form action="{{ route('admin.pemesanan.update', $p->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm border-warning text-center fw-semibold">
                                        <option value="pending" {{ $p->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="diproses" {{ $p->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai" {{ $p->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="dibatalkan" {{ $p->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                </form>
                            </td>
                            <td>{{ $p->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.pemesanan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-warning fw-semibold text-dark">
                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center">Belum ada data pemesanan.</div>
    @endif
</div>
@endsection
