@extends('layouts.app')

@section('title', 'Detail Pembayaran Mako')

@section('content')
    <h4 class="mb-4">Detail Pembayaran Mako</h4>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Jenis Mako</dt>
                <dd class="col-sm-8 text-capitalize">
                    {{ $pembayaran->pesananMako->formulirPemesananMako->jenis_mako }}
                </dd>

                <dt class="col-sm-4">Tanggal Pemesanan</dt>
                <dd class="col-sm-8">
                    {{ $pembayaran->pesananMako->formulirPemesananMako->tanggal_pemesanan }}
                </dd>

                <dt class="col-sm-4">Jumlah</dt>
                <dd class="col-sm-8">
                    {{ $pembayaran->pesananMako->formulirPemesananMako->qty }}
                </dd>

                <dt class="col-sm-4">Total Harga</dt>
                <dd class="col-sm-8">
                    Rp {{ number_format($pembayaran->pesananMako->formulirPemesananMako->total_harga, 0, ',', '.') }}
                </dd>

                <dt class="col-sm-4">Bank Tujuan</dt>
                <dd class="col-sm-8">
                    {{ $pembayaran->nama_bank_penerima }} - {{ $pembayaran->no_rekening_penerima }} a.n {{ $pembayaran->nama_penerima }}
                </dd>

                <dt class="col-sm-4">Cara Pembayaran</dt>
                <dd class="col-sm-8 text-capitalize">{{ $pembayaran->cara_pembayaran }}</dd>

                <dt class="col-sm-4">Nama Pengirim</dt>
                <dd class="col-sm-8">
                    {{ $pembayaran->nama_pengirim }} ({{ $pembayaran->nama_bank_pengirim }})
                </dd>

                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">
                    <span class="badge bg-{{ $pembayaran->status === 'lunas' ? 'success' : 'warning' }}">
                        {{ ucfirst($pembayaran->status) }}
                    </span>
                </dd>

                <dt class="col-sm-4">Bukti Pembayaran</dt>
                <dd class="col-sm-8">
                    <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid rounded border" style="max-width: 300px;">
                </dd>
            </dl>
        </div>
    </div>

    <a href="{{ route('divisi.pembayaran.index') }}" class="btn btn-secondary mt-4">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>
@endsection