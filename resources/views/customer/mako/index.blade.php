@extends('layouts.app')

@section('title', 'Daftar Pesanan Mako')

@section('content')
    <h4 class="mb-4 d-flex justify-content-between">
        <span>Daftar Pesanan Mako</span>
        <a href="{{ route('customer.mako.create') }}" class="btn btn-success btn-sm">
             Buat Pesanan Baru
        </a>
    </h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if ($pesanans->isEmpty())
        <div class="alert alert-info">Anda belum memiliki pesanan.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Jenis Mako</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanans as $index => $pesanan)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ ucfirst($pesanan->formulirPemesananMako->jenis_mako) }}</td>
                        <td class="text-center">
                            @php
                                $status = $pesanan->status;
                                $badge = match($status) {
                                    'menunggu' => 'warning',
                                    'diterima' => 'success',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ ucfirst($status) }}</span>
                        </td>
                        <td class="font-monospace">Rp {{ number_format($pesanan->formulirPemesananMako->total_harga, 0, ',', '.') }}</td>
                        <td class="text-nowrap">
                            <div class="hstack gap-1">
                                <!-- Modal trigger -->
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $pesanan->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                        
                                <a href="{{ route('customer.mako.edit', $pesanan->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                        
                                <form action="{{ route('customer.mako.destroy', $pesanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                        
                                @if ($pesanan->status === 'diterima')
                                    @if (!$pesanan->pembayaranMako)
                                        <a href="{{ route('customer.pembayaran.create', $pesanan->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-credit-card"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('customer.pembayaran.show', $pesanan->pembayaranMako->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-receipt"></i>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Modal Detail --}}
    @foreach ($pesanans as $pesanan)
    <div class="modal fade" id="detailModal{{ $pesanan->id }}" tabindex="-1" aria-labelledby="detailLabel{{ $pesanan->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pesanan Mako</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Jenis Mako</dt>
                        <dd class="col-sm-7 text-capitalize">{{ $pesanan->formulirPemesananMako->jenis_mako }}</dd>

                        <dt class="col-sm-5">Jumlah</dt>
                        <dd class="col-sm-7 font-monospace">{{ $pesanan->formulirPemesananMako->qty }}</dd>

                        <dt class="col-sm-5">Harga Satuan</dt>
                        <dd class="col-sm-7 font-monospace">Rp {{ number_format($pesanan->formulirPemesananMako->harga, 0, ',', '.') }}</dd>

                        <dt class="col-sm-5">Total Harga</dt>
                        <dd class="col-sm-7 font-monospace">Rp {{ number_format($pesanan->formulirPemesananMako->total_harga, 0, ',', '.') }}</dd>

                        <dt class="col-sm-5 font-monospace">Tanggal Pesanan</dt>
                        <dd class="col-sm-7">{{ $pesanan->formulirPemesananMako->tanggal_pemesanan }}</dd>

                        <dt class="col-sm-5">Alamat Pengiriman</dt>
                        <dd class="col-sm-7">{{ $pesanan->formulirPemesananMako->alamat_pengiriman }}</dd>

                        <dt class="col-sm-5">Status</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-{{ $pesanan->status === 'diterima' ? 'success' : 'warning' }}">
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