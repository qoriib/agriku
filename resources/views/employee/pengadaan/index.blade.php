@extends('layouts.app')

@section('title', 'Daftar Pesanan Bahan Baku')

@section('content')
<h4 class="mb-4 d-flex justify-content-between align-items-center">
    <span>Daftar Pesanan Bahan Baku</span>
    <a href="{{ route('employee.pengadaan.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Tambah Pesanan
    </a>
</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($pesanans->isEmpty())
    <div class="alert alert-info">Belum ada pesanan bahan baku.</div>
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
                    <th>Pemasok</th>
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
                    <td>{{ $pesanan->formulirPemesanan->tanggal_pemesanan }}</td>
                    <td>{{ $pesanan->pemasok->nama_perusahaan ?? '-' }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $pesanan->status === 'menunggu' ? 'warning' : 'success' }}">
                            {{ ucfirst($pesanan->status) }}
                        </span>
                    </td>
                    <td class="text-nowrap text-center">
                        <!-- Modal trigger -->
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $pesanan->id }}">
                            <i class="fas fa-eye"></i>
                        </button>
                    
                        <a href="{{ route('employee.pengadaan.edit', $pesanan->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    
                        <form action="{{ route('employee.pengadaan.destroy', $pesanan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    
                        @if($pesanan->status === 'diterima' && !$pesanan->pembayaranBahanBaku)
                            <a href="{{ route('employee.pembayaran.create', $pesanan->id) }}" class="btn btn-success btn-sm mt-1">
                                <i class="fas fa-credit-card"></i> Bayar
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

{{-- Modal detail --}}
@foreach ($pesanans as $pesanan)
<div class="modal fade" id="detailModal{{ $pesanan->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $pesanan->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-sm-5">Kode Pesanan</dt>
                    <dd class="col-sm-7 font-monospace">{{ $pesanan->formulirPemesanan->kode_pemesanan_bahan_baku }}</dd>

                    <dt class="col-sm-5">Nama Bahan</dt>
                    <dd class="col-sm-7">{{ $pesanan->formulirPemesanan->nama_bahan_baku }}</dd>

                    <dt class="col-sm-5">Jumlah</dt>
                    <dd class="col-sm-7">{{ $pesanan->formulirPemesanan->qty }}</dd>

                    <dt class="col-sm-5">Tanggal Pemesanan</dt>
                    <dd class="col-sm-7">{{ $pesanan->formulirPemesanan->tanggal_pemesanan }}</dd>

                    <dt class="col-sm-5">Alamat Pengiriman</dt>
                    <dd class="col-sm-7">{{ $pesanan->formulirPemesanan->alamat_pengiriman }}</dd>

                    <dt class="col-sm-5">Harga</dt>
                    <dd class="col-sm-7 font-monospace">Rp {{ number_format($pesanan->formulirPemesanan->harga, 0, ',', '.') }}</dd>

                    <dt class="col-sm-5">Pajak</dt>
                    <dd class="col-sm-7 font-monospace">Rp {{ number_format($pesanan->formulirPemesanan->pajak, 0, ',', '.') }}</dd>

                    <dt class="col-sm-5">Total</dt>
                    <dd class="col-sm-7 font-monospace">Rp {{ number_format($pesanan->formulirPemesanan->total_harga, 0, ',', '.') }}</dd>

                    <dt class="col-sm-5">Pemasok</dt>
                    <dd class="col-sm-7">{{ $pesanan->pemasok->nama_perusahaan ?? '-' }}</dd>

                    <dt class="col-sm-5">Status</dt>
                    <dd class="col-sm-7">
                        <span class="badge bg-{{ $pesanan->status === 'menunggu' ? 'warning' : 'success' }}">
                            {{ ucfirst($pesanan->status) }}
                        </span>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection