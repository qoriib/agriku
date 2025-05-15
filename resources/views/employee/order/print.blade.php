@extends('layouts.print')

@section('title', 'Cetak Daftar Order Mako')

@section('content')
    <h4 class="mb-4 text-center">Daftar Order Mako</h4>

    <table class="table table-bordered align-middle">
        <thead class="table-light text-center">
            <tr>
                <th>No</th>
                <th>Nama Konsumen</th>
                <th>Jenis Mako</th>
                <th>Jumlah</th>
                <th>Alamat</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Status Produksi</th>
                <th>Status Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $order->konsumen->user->name ?? '-' }}</td>
                <td>{{ $order->formulirPemesananMako->jenis_mako ?? '-' }}</td>
                <td class="text-center">{{ $order->formulirPemesananMako->qty ?? '-' }}</td>
                <td>{{ $order->formulirPemesananMako->alamat_pengiriman ?? '-' }}</td>
                <td class="text-center">{{ $order->formulirPemesananMako->tanggal_pemesanan ?? '-' }}</td>
                <td class="text-end font-monospace">
                    Rp {{ number_format($order->formulirPemesananMako->total_harga ?? 0, 0, ',', '.') }}
                </td>
                <td class="text-center">{{ ucfirst($order->status) }}</td>
                <td class="text-center">
                    {{ $order->pengirimanMako->status ?? 'Belum dikirim' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
