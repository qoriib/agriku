@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pengiriman Mako</h2>

    <form action="{{ route('employee.pengiriman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Pesanan Mako</label>
            <select name="id_pesanan_mako" class="form-control" required>
                @foreach ($pesanans as $pesanan)
                    <option value="{{ $pesanan->id }}">
                        {{ $pesanan->formulirPemesananMako->jenis_mako }} - {{ $pesanan->formulirPemesananMako->tanggal_pemesanan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Estimasi Tanggal Sampai</label>
            <input type="date" name="estimasi_sampai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Bukti Pengiriman</label>
            <input type="file" name="bukti_pengiriman" class="form-control" accept="image/*" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection