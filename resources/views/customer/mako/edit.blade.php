@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pesanan Mako</h2>
    
    <form action="{{ route('customer.mako.update', $pesanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Jenis Mako -->
        <div class="mb-3">
            <label for="jenis_mako" class="form-label">Jenis Mako</label>
            <select class="form-select" name="jenis_mako" required>
                <option value="raskin" {{ $pesanan->formulirPemesananMako->jenis_mako == 'raskin' ? 'selected' : '' }}>Raskin</option>
                <option value="premium" {{ $pesanan->formulirPemesananMako->jenis_mako == 'premium' ? 'selected' : '' }}>Premium</option>
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="qty" class="form-label">Jumlah (Qty)</label>
            <input type="number" class="form-control" id="qty" name="qty" value="{{ $pesanan->formulirPemesananMako->qty }}" required>
        </div>

        <!-- Tanggal Pemesanan -->
        <div class="mb-3">
            <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
            <input type="date" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" value="{{ $pesanan->formulirPemesananMako->tanggal_pemesanan }}" required>
        </div>

        <!-- Alamat Pengiriman -->
        <div class="mb-3">
            <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
            <textarea class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" rows="3" required>{{ $pesanan->formulirPemesananMako->alamat_pengiriman }}</textarea>
        </div>

        <!-- Harga -->
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ $pesanan->formulirPemesananMako->harga }}" required>
        </div>

        <!-- Pajak -->
        <div class="mb-3">
            <label for="pajak" class="form-label">Pajak</label>
            <input type="number" class="form-control" id="pajak" name="pajak" value="{{ $pesanan->formulirPemesananMako->pajak }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Pesanan</button>
    </form>
</div>
@endsection