@extends('layouts.app')

@section('title', 'Pengiriman Bahan Baku')

@section('content')
<h4 class="mb-4">Pengiriman Bahan Baku</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($pengirimans->isEmpty())
    <div class="alert alert-info">Belum ada data pengiriman.</div>
@else
<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light text-center">
            <tr>
                <th>No</th>
                <th>Kode Pemesanan</th>
                <th>Nama Bahan</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengirimans as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="font-monospace text-center">{{ $item->pesananBahanBaku->formulirPemesanan->kode_pemesanan_bahan_baku }}</td>
                <td>{{ $item->pesananBahanBaku->formulirPemesanan->nama_bahan_baku }}</td>
                <td class="text-center">
                    <span class="badge bg-{{ $item->status === 'diterima' ? 'success' : 'warning' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="text-center">
                    @if ($item->bukti_pengiriman)
                        <a href="{{ asset('storage/' . $item->bukti_pengiriman) }}" target="_blank">
                            <img src="{{ asset('storage/' . $item->bukti_pengiriman) }}" style="max-height: 100px;" class="img-thumbnail">
                        </a>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('supplier.pengiriman.edit', $item->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Ubah
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection