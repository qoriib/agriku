@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="hstack align-items-center justify-content-between gap-2 mb-4">
        <h2 class="h4 flex-grow-1 mb-0">Laporan Penjualan</h2>
        <a href="{{ route('employee.laporan.penjualan.print', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}" class="btn btn-secondary btn-sm">
            Cetak Laporan
        </a>
    </div>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Dari Tanggal</label>
            <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Sampai Tanggal</label>
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Konsumen</th>
                    <th>Jenis Mako</th>
                    <th>Jumlah</th>
                    <th>Cara Pembayaran</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanans as $index => $pesanan)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center font-monospace">{{ $pesanan->formulirPemesananMako->tanggal_pemesanan ?? '-' }}</td>
                        <td>{{ $pesanan->konsumen->user->name ?? '-' }}</td>
                        <td>{{ ucwords($pesanan->formulirPemesananMako->jenis_mako) ?? '-' }}</td>
                        <td class="text-center">{{ $pesanan->formulirPemesananMako->qty ?? '-' }}</td>
                        <td class="text-center">
                            {{ ucwords($pesanan->pembayaranMako->cara_pembayaran ?? 'Belum dibayar') }}
                        </td>
                        <td class="text-end font-monospace">
                            Rp {{ number_format($pesanan->formulirPemesananMako->total_harga ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection