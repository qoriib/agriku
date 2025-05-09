@extends('layouts.app')

@section('title', 'Edit Pesanan Bahan Baku')

@section('content')
<h4 class="mb-4">Edit Pesanan Bahan Baku</h4>

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
        <form action="{{ route('supplier.pesanan.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="vstack gap-3">
                <div>
                    <label class="form-label">Kode Pemesanan</label>
                    <input type="text" name="kode_pemesanan_bahan_baku" class="form-control" value="{{ old('kode_pemesanan_bahan_baku', $pesanan->formulirPemesanan->kode_pemesanan_bahan_baku) }}" required>
                </div>

                <div>
                    <label class="form-label">Nama Bahan Baku</label>
                    <input type="text" name="nama_bahan_baku" class="form-control" value="{{ old('nama_bahan_baku', $pesanan->formulirPemesanan->nama_bahan_baku) }}" required>
                </div>

                <div>
                    <label class="form-label">Jumlah (Qty)</label>
                    <input type="number" name="qty" class="form-control" value="{{ old('qty', $pesanan->formulirPemesanan->qty) }}" required>
                </div>

                <div>
                    <label class="form-label">Tanggal Pemesanan</label>
                    <input type="date" name="tanggal_pemesanan" class="form-control" value="{{ old('tanggal_pemesanan', $pesanan->formulirPemesanan->tanggal_pemesanan) }}" required>
                </div>

                <div>
                    <label class="form-label">Alamat Pengiriman</label>
                    <textarea name="alamat_pengiriman" class="form-control" rows="3" required>{{ old('alamat_pengiriman', $pesanan->formulirPemesanan->alamat_pengiriman) }}</textarea>
                </div>

                <div>
                    <label class="form-label">Harga Satuan</label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga', $pesanan->formulirPemesanan->harga) }}" required>
                </div>

                <div>
                    <label class="form-label">Pajak</label>
                    <input type="number" name="pajak" class="form-control" value="{{ old('pajak', $pesanan->formulirPemesanan->pajak) }}" required>
                </div>

                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="menunggu" {{ $pesanan->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diterima" {{ $pesanan->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('supplier.pesanan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection