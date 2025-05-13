@extends('layouts.app')

@section('title', 'Tambah Pengiriman')

@section('content')
<h4 class="mb-4">Form Tambah Pengiriman Bahan Baku</h4>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('supplier.pengiriman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_pesanan_bahan_baku" value="{{ $pesanan->id }}">
            <div class="vstack gap-3">
                <div>
                    <label class="form-label">Kode Pemesanan</label>
                    <input type="text" class="form-control" value="{{ $pesanan->formulirPemesanan->kode_pemesanan_bahan_baku }}" disabled>
                </div>

                <div>
                    <label class="form-label">Estimasi Sampai</label>
                    <input type="date" name="estimasi_sampai" class="form-control" required>
                </div>

                <div>
                    <label class="form-label">Bukti Pengiriman</label>
                    <input type="file" name="bukti_pengiriman" class="form-control" accept="image/*" required>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('supplier.pengiriman.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection