@extends('layouts.app')

@section('title', 'Detail Pembayaran Bahan Baku')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Pembayaran</h5>
        <a href="{{ route('employee.pembayaran.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-4">Kode Pemesanan</dt>
            <dd class="col-sm-8 font-monospace">{{ $pembayaran->pesananBahanBaku->formulirPemesanan->kode_pemesanan_bahan_baku }}</dd>

            <dt class="col-sm-4">Tanggal Pemesanan</dt>
            <dd class="col-sm-8">{{ $pembayaran->pesananBahanBaku->formulirPemesanan->tanggal_pemesanan }}</dd>

            <dt class="col-sm-4">Nama Bahan Baku</dt>
            <dd class="col-sm-8">{{ $pembayaran->pesananBahanBaku->formulirPemesanan->nama_bahan_baku }}</dd>

            <dt class="col-sm-4">Jumlah</dt>
            <dd class="col-sm-8">{{ $pembayaran->pesananBahanBaku->formulirPemesanan->qty }}</dd>

            <dt class="col-sm-4">Total Harga</dt>
            <dd class="col-sm-8">Rp {{ number_format($pembayaran->pesananBahanBaku->formulirPemesanan->total_harga, 0, ',', '.') }}</dd>

            <hr>

            <dt class="col-sm-4">No Rekening Penerima</dt>
            <dd class="col-sm-8">{{ $pembayaran->no_rekening_penerima }}</dd>

            <dt class="col-sm-4">Bank Penerima</dt>
            <dd class="col-sm-8">{{ $pembayaran->nama_bank_penerima }}</dd>

            <dt class="col-sm-4">Nama Pengirim</dt>
            <dd class="col-sm-8">{{ $pembayaran->nama_pengirim }}</dd>

            <dt class="col-sm-4">Bank Pengirim</dt>
            <dd class="col-sm-8">{{ $pembayaran->nama_bank_pengirim }}</dd>

            <dt class="col-sm-4">Status</dt>
            <dd class="col-sm-8">
                <span class="badge bg-{{ $pembayaran->status === 'lunas' ? 'success' : 'warning' }}">
                    {{ ucfirst($pembayaran->status) }}
                </span>
            </dd>

            <dt class="col-sm-4">Bukti Pembayaran</dt>
            <dd class="col-sm-8">
                <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">
                    <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid img-thumbnail" style="max-height: 250px;">
                </a>
            </dd>
        </dl>
    </div>
</div>
@endsection