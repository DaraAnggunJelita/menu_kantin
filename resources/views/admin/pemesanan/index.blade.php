@extends('layouts.app')

@section('title', 'Data Pemesanan')

@section('content')
<div class="container py-4">
    <h4 class="mb-4 fw-bold text-success">📦 Data Pemesanan</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($pemesanans->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-success">
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
                        <tr>
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
    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
        <option value="pending" {{ $p->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="diproses" {{ $p->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="selesai" {{ $p->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="dibatalkan" {{ $p->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
    </select>
</form>

                            </td>
                            <td>{{ $p->created_at->format('d M Y, H:i') }}</td>
                            <td>-</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">Belum ada data pemesanan.</div>
    @endif
</div>
@endsection
