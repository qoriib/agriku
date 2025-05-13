@extends('layouts.app')

@section('title', 'Edit Status Pembayaran')

@section('content')
<h4 class="mb-4">Edit Status Pembayaran</h4>

<div class="card">
    <div class="card-body">
        <form action="{{ route('supplier.pembayaran.update', $pembayaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <dl class="row mb-4">
                <dt class="col-sm-4">Kode Pemesanan</dt>
                <dd class="col-sm-8 font-monospace">{{ $pembayaran->pesananBahanBaku->formulirPemesanan->kode_pemesanan_bahan_baku }}</dd>

                <dt class="col-sm-4">Nama Pengirim</dt>
                <dd class="col-sm-8">{{ $pembayaran->nama_pengirim }}</dd>

                <dt class="col-sm-4">Bank Pengirim</dt>
                <dd class="col-sm-8">{{ $pembayaran->nama_bank_pengirim }}</dd>

                <dt class="col-sm-4">Bank Penerima</dt>
                <dd class="col-sm-8">{{ $pembayaran->nama_bank_penerima }}</dd>

                <dt class="col-sm-4">No Rekening</dt>
                <dd class="col-sm-8">{{ $pembayaran->no_rekening_penerima }}</dd>

                <dt class="col-sm-4">Bukti Pembayaran</dt>
                <dd class="col-sm-8">
                    <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">
                        <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid rounded border" style="max-height: 200px;">
                    </a>
                </dd>
            </dl>

            <div class="mb-3">
                <label class="form-label">Status Pembayaran</label>
                <select name="status" class="form-select" required>
                    <option value="menunggu pembayaran" {{ $pembayaran->status == 'menunggu pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="lunas" {{ $pembayaran->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('supplier.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection