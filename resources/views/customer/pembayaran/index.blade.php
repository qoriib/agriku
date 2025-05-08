@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pembayaran Mako</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pesanan</th>
                <th>Bank Tujuan</th>
                <th>Pengirim</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembayarans as $pembayaran)
            <tr>
                <td>
                    {{ $pembayaran->pesananMako->formulirPemesananMako->jenis_mako }} -
                    {{ $pembayaran->pesananMako->formulirPemesananMako->tanggal_pemesanan }}
                </td>
                <td>
                    {{ $pembayaran->nama_bank_penerima }}<br>
                    {{ $pembayaran->no_rekening_penerima }} a.n {{ $pembayaran->nama_penerima }}
                </td>
                <td>
                    {{ $pembayaran->nama_pengirim }}<br>
                    {{ $pembayaran->nama_bank_pengirim }}
                </td>
                <td>
                    <span class="badge bg-{{ $pembayaran->status == 'lunas' ? 'success' : 'warning' }}">
                        {{ ucfirst($pembayaran->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">Lihat</a>
                </td>
                <td>
                    <a href="{{ route('customer.pembayaran.show', $pembayaran->id) }}" class="btn btn-info btn-sm">Detail</a>
                    @if ($pembayaran->status != 'lunas')
                    <form action="{{ route('customer.pembayaran.destroy', $pembayaran->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus pembayaran ini?')">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada pembayaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection