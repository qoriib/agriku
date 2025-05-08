@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pembayaran</h1>

    <table class="table table-bordered">
        <tr><th>Jenis Mako</th><td>{{ $pembayaran->pesananMako->formulirPemesananMako->jenis_mako }}</td></tr>
        <tr><th>Tanggal Pemesanan</th><td>{{ $pembayaran->pesananMako->formulirPemesananMako->tanggal_pemesanan }}</td></tr>
        <tr><th>Harga Total</th><td>Rp {{ number_format($pembayaran->pesananMako->formulirPemesananMako->total_harga, 0, ',', '.') }}</td></tr>
        <tr><th>Nama Penerima</th><td>{{ $pembayaran->nama_penerima }}</td></tr>
        <tr><th>Bank Penerima</th><td>{{ $pembayaran->nama_bank_penerima }}</td></tr>
        <tr><th>Rekening Penerima</th><td>{{ $pembayaran->no_rekening_penerima }}</td></tr>
        <tr><th>Pengirim</th><td>{{ $pembayaran->nama_pengirim }}</td></tr>
        <tr><th>Bank Pengirim</th><td>{{ $pembayaran->nama_bank_pengirim }}</td></tr>
        <tr><th>Status</th>
            <td>
                <span class="badge bg-{{ $pembayaran->status == 'lunas' ? 'success' : 'warning' }}">
                    {{ ucfirst($pembayaran->status) }}
                </span>
            </td>
        </tr>
        <tr>
            <th>Bukti Pembayaran</th>
            <td>
                <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">
                    <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti" width="300">
                </a>
            </td>
        </tr>
    </table>

    <a href="{{ route('customer.mako.show', $pembayaran->pesananMako->id) }}" class="btn btn-secondary">Kembali ke Pesanan</a>
</div>
@endsection