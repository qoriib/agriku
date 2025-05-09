@extends('layouts.app')

@section('title', 'Edit Pesanan Mako')

@section('content')
<h4 class="mb-4">Edit Pesanan Mako</h4>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('customer.mako.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="vstack gap-3">

                {{-- Jenis Mako --}}
                <div>
                    <label class="form-label">Jenis Mako</label>
                    <select class="form-select" name="jenis_mako" required>
                        <option value="raskin" {{ $pesanan->formulirPemesananMako->jenis_mako === 'raskin' ? 'selected' : '' }}>Raskin</option>
                        <option value="premium" {{ $pesanan->formulirPemesananMako->jenis_mako === 'premium' ? 'selected' : '' }}>Premium</option>
                    </select>
                </div>

                {{-- Jumlah --}}
                <div>
                    <label class="form-label">Jumlah (Qty)</label>
                    <input type="number" name="qty" class="form-control" value="{{ $pesanan->formulirPemesananMako->qty }}" required>
                </div>

                {{-- Tanggal Pemesanan --}}
                <div>
                    <label class="form-label">Tanggal Pemesanan</label>
                    <input type="date" name="tanggal_pemesanan" class="form-control" value="{{ $pesanan->formulirPemesananMako->tanggal_pemesanan }}" required>
                </div>

                {{-- Alamat Pengiriman --}}
                <div>
                    <label class="form-label">Alamat Pengiriman</label>
                    <textarea name="alamat_pengiriman" class="form-control" rows="3" required>{{ $pesanan->formulirPemesananMako->alamat_pengiriman }}</textarea>
                </div>

                {{-- Harga --}}
                <div>
                    <label class="form-label">Harga per Unit</label>
                    <input type="number" name="harga" class="form-control" value="{{ $pesanan->formulirPemesananMako->harga }}" required>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customer.mako.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Pesanan</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection