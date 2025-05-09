@extends('layouts.app')

@section('title', 'Detail Pembayaran Mako')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Pembayaran</h5>
        <a href="{{ route('divisi.pembayaran.index') }}" class="btn btn-secondary btn-sm">
            Kembali
        </a>
    </div>
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-4">Jenis Mako</dt>
            <dd class="col-sm-8">{{ ucfirst($pembayaran->pesananMako->formulirPemesananMako->jenis_mako) }}</dd>

            <dt class="col-sm-4">Tanggal Pemesanan</dt>
            <dd class="col-sm-8">{{ $pembayaran->pesananMako->formulirPemesananMako->tanggal_pemesanan }}</dd>

            <dt class="col-sm-4">Jumlah</dt>
            <dd class="col-sm-8">{{ $pembayaran->pesananMako->formulirPemesananMako->qty }}</dd>

            <dt class="col-sm-4">Harga Total</dt>
            <dd class="col-sm-8">Rp {{ number_format($pembayaran->pesananMako->formulirPemesananMako->total_harga, 0, ',', '.') }}</dd>

            <hr>

            <dt class="col-sm-4">No Rekening Penerima</dt>
            <dd class="col-sm-8">{{ $pembayaran->no_rekening_penerima }}</dd>

            <dt class="col-sm-4">Bank Penerima</dt>
            <dd class="col-sm-8">{{ $pembayaran->nama_bank_penerima }} a.n {{ $pembayaran->nama_penerima }}</dd>

            <dt class="col-sm-4">Cara Pembayaran</dt>
            <dd class="col-sm-8 text-capitalize">{{ $pembayaran->cara_pembayaran }}</dd>

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