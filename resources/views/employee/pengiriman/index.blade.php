@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pengiriman Mako</h2>

    <a href="{{ route('employee.pengiriman.create') }}" class="btn btn-primary mb-3">Tambah Pengiriman</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pesanan</th>
                <th>Konsumen</th>
                <th>Estimasi Sampai</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengirimans as $pengiriman)
            <tr>
                <td>{{ $pengiriman->pesananMako->formulirPemesananMako->jenis_mako }}</td>
                <td>{{ $pengiriman->pesananMako->konsumen->user->name ?? '-' }}</td>
                <td>{{ $pengiriman->estimasi_sampai }}</td>
                <td>
                    <span class="badge bg-{{ $pengiriman->status === 'diterima' ? 'success' : ($pengiriman->status === 'terlambat' ? 'danger' : 'warning') }}">
                        {{ ucfirst($pengiriman->status) }}
                    </span>
                </td>
                <td>
                    @if ($pengiriman->bukti_pesanan_diterima)
                        <a href="{{ asset('storage/' . $pengiriman->bukti_pesanan_diterima) }}" target="_blank">Lihat</a>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('employee.pengiriman.edit', $pengiriman->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('employee.pengiriman.destroy', $pengiriman->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection