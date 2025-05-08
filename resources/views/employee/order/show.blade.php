@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pesanan Bahan Baku</h2>
    <div class="mb-3">
        <strong>Kode Pemesanan:</strong> {{ $pesanan->formulirPemesanan->kode_pemesanan_bahan_baku }}
    </div>
    <div class="mb-3">
        <strong>Nama Bahan Baku:</strong> {{ $pesanan->formulirPemesanan->nama_bahan_baku }}
    </div>
    <div class="mb-3">
        <strong>Jumlah (Qty):</strong> {{ $pesanan->formulirPemesanan->qty }}
    </div>
    <div class="mb-3">
        <strong>Tanggal Pemesanan:</strong> {{ $pesanan->formulirPemesanan->tanggal_pemesanan }}
    </div>
    <div class="mb-3">
        <strong>Alamat Pengiriman:</strong> {{ $pesanan->formulirPemesanan->alamat_pengiriman }}
    </div>
    <div class="mb-3">
        <strong>Harga:</strong> {{ $pesanan->formulirPemesanan->harga }}
    </div>
    <div class="mb-3">
        <strong>Pajak:</strong> {{ $pesanan->formulirPemesanan->pajak }}
    </div>
    <div class="mb-3">
        <strong>Total Harga:</strong> {{ $pesanan->formulirPemesanan->total_harga }}
    </div>
    <div class="mb-3">
        <strong>Status Pesanan:</strong> {{ $pesanan->status }}
    </div>

    <a href="{{ route('customer.pesanan.paymentStatus', $pesanan->id) }}" class="btn btn-info">Lihat Status Pembayaran</a>
</div>
@endsection