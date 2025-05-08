@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pesanan Mako</h2>
    
    <div class="mb-3">
        <strong>Jenis Mako:</strong> {{ $pesanan->formulirPemesananMako->jenis_mako }}
    </div>
    <div class="mb-3">
        <strong>Status Pesanan:</strong> {{ $pesanan->status }}
    </div>
    <div class="mb-3">
        <strong>Total Harga:</strong> {{ $pesanan->formulirPemesananMako->total_harga }}
    </div>
    <div class="mb-3">
        <strong>Alamat Pengiriman:</strong> {{ $pesanan->formulirPemesananMako->alamat_pengiriman }}
    </div>

    <a href="{{ route('customer.mako.index') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
</div>
@endsection