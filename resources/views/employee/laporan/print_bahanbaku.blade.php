@extends('layouts.print')

@section('title', 'Cetak Laporan Bahan Baku')

@section('content')
    <h4 class="text-center mb-3">Laporan Bahan Baku</h4>

    <p class="text-center">
        Periode:
        {{ $tanggalAwal ? \Carbon\Carbon::parse($tanggalAwal)->format('d M Y') : '-' }} -
        {{ $tanggalAkhir ? \Carbon\Carbon::parse($tanggalAkhir)->format('d M Y') : '-' }}
    </p>

    <table class="table table-bordered table-sm align-middle">
        <thead class="table-light text-center">
            <tr>
                <th>No</th>
                <th>Tanggal Masuk</th>
                <th>Pemasok</th>
                <th>Jenis Bahan Baku</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanans as $index => $pesanan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $pesanan->formulirPemesanan->tanggal_pemesanan }}</td>
                    <td>{{ $pesanan->pemasok->nama_perusahaan ?? '-' }}</td>
                    <td>{{ $pesanan->formulirPemesanan->nama_bahan_baku }}</td>
                    <td class="text-center">{{ $pesanan->formulirPemesanan->qty }}</td>
                    <td class="text-end">Rp {{ number_format($pesanan->formulirPemesanan->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection