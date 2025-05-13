@extends('layouts.app')

@section('title', 'Pembayaran Bahan Baku')

@section('content')
<h4 class="mb-4">Pembayaran Bahan Baku</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($pembayarans->isEmpty())
    <div class="alert alert-info">Tidak ada pembayaran ditemukan.</div>
@else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Kode Pemesanan</th>
                    <th>Nama Pengirim</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayarans as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-monospace">{{ $item->pesananBahanBaku->formulirPemesanan->kode_pemesanan_bahan_baku }}</td>
                    <td>{{ $item->nama_pengirim }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $item->status === 'lunas' ? 'success' : 'warning' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="text-nowrap text-center">
                        <a href="{{ route('supplier.pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection