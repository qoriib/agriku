@extends('layouts.app')

@section('title', 'Konfirmasi Penerimaan')

@section('content')
<div class="container">
    <h4 class="mb-4">Konfirmasi Penerimaan Mako</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('customer.pengiriman.konfirmasi.submit', $pengiriman->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <p><strong>Jenis Mako:</strong> {{ ucfirst($pengiriman->pesananMako->formulirPemesananMako->jenis_mako) }}</p>
                <p><strong>Estimasi Sampai:</strong> {{ $pengiriman->estimasi_sampai }}</p>

                <div class="mb-3">
                    <label for="bukti_pesanan_diterima" class="form-label">Upload Bukti Penerimaan (jpg/png)</label>
                    <input type="file" name="bukti_pesanan_diterima" class="form-control" accept="image/*" required>
                    @error('bukti_pesanan_diterima')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Konfirmasi Diterima</button>
                <a href="{{ route('customer.pengiriman.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection