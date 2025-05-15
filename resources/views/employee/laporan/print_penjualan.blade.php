@extends('layouts.print')

@section('title', 'Laporan Penjualan')

@section('content')
    <h4 class="mb-3 text-center">Laporan Penjualan</h4>
    
    <p class="text-center">
        Periode:
        {{ $tanggalAwal ? \Carbon\Carbon::parse($tanggalAwal)->format('d M Y') : '-' }} -
        {{ $tanggalAkhir ? \Carbon\Carbon::parse($tanggalAkhir)->format('d M Y') : '-' }}
    </p>

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
                    <td class="text-center font-monospace">
                        {{ $pesanan->formulirPemesananMako->tanggal_pemesanan ?? '-' }}
                    </td>
                    <td>{{ $pesanan->konsumen->user->name ?? '-' }}</td>
                    <td>{{ ucwords($pesanan->formulirPemesananMako->jenis_mako ?? '-') }}</td>
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
@endsection