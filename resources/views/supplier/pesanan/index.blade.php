@extends('layouts.app')

@section('title', 'Pesanan Bahan Baku dari Agriku')

@section('content')
<h4 class="mb-4">Pesanan Bahan Baku Diterima</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($pesanans->isEmpty())
    <div class="alert alert-info">Belum ada pesanan bahan baku dari staf pengadaan.</div>
@else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Bahan</th>
                    <th>Qty</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                    <th>Staf Pemesan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanans as $index => $pesanan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-monospace text-center">{{ $pesanan->formulirPemesanan->kode_pemesanan_bahan_baku }}</td>
                    <td>{{ $pesanan->formulirPemesanan->nama_bahan_baku }}</td>
                    <td class="text-center">{{ $pesanan->formulirPemesanan->qty }}</td>
                    <td class="font-monospace">Rp {{ number_format($pesanan->formulirPemesanan->total_harga, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $pesanan->formulirPemesanan->tanggal_pemesanan }}</td>
                    <td>{{ $pesanan->karyawan->user->name ?? '-' }}</td>
                    <td class="text-center">
                        <form action="{{ route('supplier.pesanan.updateStatus', $pesanan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="menunggu" {{ $pesanan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diterima" {{ $pesanan->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            </select>
                        </form>
                    </td>
                    <td class="text-nowrap text-center">
                        <a href="{{ route('supplier.pesanan.edit', $pesanan->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('supplier.pesanan.destroy', $pesanan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @if($pesanan->status === 'diterima' && !$pesanan->pengirimanBahanBaku)
                            <a href="{{ route('supplier.pengiriman.create', $pesanan->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-truck"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection