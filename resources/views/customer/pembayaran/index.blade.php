@extends('layouts.app')

@section('title', 'Daftar Pembayaran Mako')

@section('content')
    <h4 class="mb-4">Daftar Pembayaran Mako</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>Pesanan</th>
                    <th>Bank Tujuan</th>
                    <th>Pengirim</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayarans as $pembayaran)
                <tr>
                    <td>
                        <strong>{{ ucfirst($pembayaran->pesananMako->formulirPemesananMako->jenis_mako) }}</strong><br>
                        <small class="font-monospace text-nowrap">{{ $pembayaran->pesananMako->formulirPemesananMako->tanggal_pemesanan }}</small>
                    </td>
                    <td>
                        <span class="d-block">{{ $pembayaran->nama_bank_penerima }}</span>
                        <small>{{ $pembayaran->no_rekening_penerima }} a.n {{ $pembayaran->nama_penerima }}</small>
                    </td>
                    <td>
                        <span class="d-block">{{ $pembayaran->nama_pengirim }}</span>
                        <small>{{ $pembayaran->nama_bank_pengirim }}</small>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-{{ $pembayaran->status === 'lunas' ? 'success' : 'warning' }}">
                            {{ ucfirst($pembayaran->status) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-outline-dark btn-sm">
                            <i class="fas fa-image"></i>
                        </a>
                    </td>
                    <td class="text-nowrap">
                        <a href="{{ route('customer.pembayaran.show', $pembayaran->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if ($pembayaran->status !== 'lunas')
                            <form action="{{ route('customer.pembayaran.destroy', $pembayaran->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pembayaran ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
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