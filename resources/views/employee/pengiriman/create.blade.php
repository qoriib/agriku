@extends('layouts.app')

@section('title', 'Tambah Pengiriman Mako')

@section('content')
<h4 class="mb-4">Form Tambah Pengiriman Mako</h4>

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
        <form action="{{ route('employee.pengiriman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="vstack gap-3">
                <div>
                    <label class="form-label">Pesanan Mako</label>
                    <select name="id_pesanan_mako" class="form-select" required>
                        <option disabled selected>Pilih pesanan</option>
                        @foreach($pesanans as $pesanan)
                            <option value="{{ $pesanan->id }}" {{ old('id_pesanan_mako') == $pesanan->id ? 'selected' : '' }}>
                                {{ $pesanan->formulirPemesananMako->jenis_mako }} - {{ $pesanan->formulirPemesananMako->tanggal_pemesanan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Estimasi Sampai</label>
                    <input type="date" name="estimasi_sampai" class="form-control" value="{{ old('estimasi_sampai') }}" required>
                </div>

                <div>
                    <label class="form-label">Bukti Pengiriman</label>
                    <input type="file" name="bukti_pengiriman" class="form-control" accept="image/*" required>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('employee.pengiriman.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection