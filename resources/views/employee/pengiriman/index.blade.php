@extends('layouts.app')

@section('title', 'Data Pengiriman Mako')

@section('content')
<h4 class="mb-4 d-flex justify-content-between">
    <span>Daftar Pengiriman Mako</span>
    <a href="{{ route('employee.pengiriman.create') }}" class="btn btn-success btn-sm">
         Tambah Pengiriman
    </a>
</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light text-center">
            <tr>
                <th>No</th>
                <th>Pesanan</th>
                <th>Estimasi Sampai</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengirimans as $i => $item)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $item->pesananMako->formulirPemesananMako->jenis_mako ?? '-' }}</td>
                <td>{{ $item->estimasi_sampai }}</td>
                <td>
                    <span class="badge bg-{{ [
                        'dikirim' => 'warning',
                        'terlambat' => 'danger',
                        'diterima' => 'success'
                    ][$item->status] ?? 'secondary' }}">{{ ucfirst($item->status) }}</span>
                </td>
                <td class="text-center">
                    @if($item->bukti_pesanan_diterima)
                        <a href="{{ asset('storage/' . $item->bukti_pesanan_diterima) }}" target="_blank" class="btn btn-outline-secondary btn-sm">Lihat</a>
                    @else
                        <em class="text-muted">Belum ada</em>
                    @endif
                </td>
                <td class="text-nowrap text-center">
                    <a href="{{ route('employee.pengiriman.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('employee.pengiriman.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection