@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pengiriman</h2>

    <form action="{{ route('employee.pengiriman.update', $pengiriman->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Estimasi Sampai</label>
            <input type="date" name="estimasi_sampai" value="{{ $pengiriman->estimasi_sampai->format('Y-m-d') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="dikirim" {{ $pengiriman->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="terlambat" {{ $pengiriman->status == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                <option value="diterima" {{ $pengiriman->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Ganti Bukti Serah Terima (opsional)</label>
            <input type="file" name="bukti_pesanan_diterima" class="form-control" accept="image/*">
            @if ($pengiriman->bukti_pesanan_diterima)
                <small>File saat ini: <a href="{{ asset('storage/' . $pengiriman->bukti_pesanan_diterima) }}" target="_blank">Lihat</a></small>
            @endif
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection