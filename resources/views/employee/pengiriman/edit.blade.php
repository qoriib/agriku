@extends('layouts.app')

@section('title', 'Edit Pengiriman Mako')

@section('content')
<h4 class="mb-4">Form Edit Pengiriman</h4>

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
        <form action="{{ route('employee.pengiriman.update', $pengiriman->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="vstack gap-3">
                <div>
                    <label class="form-label">Estimasi Sampai</label>
                    <input type="date" name="estimasi_sampai" class="form-control"
                        value="{{ old('estimasi_sampai', $pengiriman->estimasi_sampai) }}" required>
                </div>

                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="dikirim" {{ old('status', $pengiriman->status) == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="terlambat" {{ old('status', $pengiriman->status) == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                        <option value="diterima" {{ old('status', $pengiriman->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Bukti Pesanan Diterima</label>
                    @if($pengiriman->bukti_pesanan_diterima)
                        <div class="mb-2">
                            <a href="{{ asset('storage/' . $pengiriman->bukti_pesanan_diterima) }}" target="_blank">Lihat Gambar Sebelumnya</a>
                        </div>
                    @endif
                    <input type="file" name="bukti_pesanan_diterima" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('employee.pengiriman.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection