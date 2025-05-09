@extends('layouts.app')

@section('title', 'Tambah Pembayaran Bahan Baku')

@section('content')
<h4 class="mb-4">Form Tambah Pembayaran Bahan Baku</h4>

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
        <form action="{{ route('employee.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_pesanan_bahan_baku" value="{{ $pesanan->id }}">

            <div class="vstack gap-3">
                <div>
                    <label class="form-label">No Rekening Penerima</label>
                    <input type="text" name="no_rekening_penerima" class="form-control" value="{{ old('no_rekening_penerima') }}" required>
                </div>

                <div>
                    <label class="form-label">Nama Bank Penerima</label>
                    <input type="text" name="nama_bank_penerima" class="form-control" value="{{ old('nama_bank_penerima') }}" required>
                </div>

                <div>
                    <label class="form-label">Nama Pengirim</label>
                    <input type="text" name="nama_pengirim" class="form-control" value="{{ old('nama_pengirim') }}" required>
                </div>

                <div>
                    <label class="form-label">Nama Bank Pengirim</label>
                    <input type="text" name="nama_bank_pengirim" class="form-control" value="{{ old('nama_bank_pengirim') }}" required>
                </div>

                <div>
                    <label class="form-label">Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*,.pdf" required>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('employee.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection