@extends('layouts.app')

@section('title', 'Manajemen Pembayaran Mako')

@section('content')
<h4 class="mb-4">Manajemen Pembayaran Mako</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light text-center">
            <tr>
                <th>No</th>
                <th>Pesanan</th>
                <th>Bank Tujuan</th>
                <th>Pengirim</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembayarans as $index => $pembayaran)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ ucfirst($pembayaran->pesananMako->formulirPemesananMako->jenis_mako) }}</strong><br>
                    <small class="font-monospace">{{ $pembayaran->pesananMako->formulirPemesananMako->tanggal_pemesanan }}</small>
                </td>
                <td>
                    {{ $pembayaran->nama_bank_penerima }}<br>
                    <small>{{ $pembayaran->no_rekening_penerima }} a.n {{ $pembayaran->nama_penerima }}</small>
                </td>
                <td>
                    {{ $pembayaran->nama_pengirim }}<br>
                    <small>{{ $pembayaran->nama_bank_pengirim }}</small>
                </td>
                <td class="text-center">
                    <form action="{{ route('divisi.pembayaran.update', $pembayaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="menunggu pembayaran" {{ $pembayaran->status == 'menunggu pembayaran' ? 'selected' : '' }}>Menunggu</option>
                            <option value="lunas" {{ $pembayaran->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                    </form>
                </td>
                <td class="text-center">
                    <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-outline-dark btn-sm">
                        <i class="fas fa-image"></i>
                    </a>
                </td>
                <td class="text-nowrap text-center">
                    <a href="{{ route('divisi.pembayaran.show', $pembayaran->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                    </a>
                    <form action="{{ route('divisi.pembayaran.destroy', $pembayaran->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada pembayaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection