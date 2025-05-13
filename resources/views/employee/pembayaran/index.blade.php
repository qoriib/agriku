@extends('layouts.app')

@section('title', 'Daftar Pembayaran Bahan Baku')

@section('content')
    <h4 class="mb-4">Daftar Pembayaran Bahan Baku</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($pembayarans->isEmpty())
        <div class="alert alert-info">Belum ada pembayaran bahan baku.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Kode Pemesanan</th>
                        <th>Nama Pengirim</th>
                        <th>Bank Penerima</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayarans as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="font-monospace">{{ $item->pesananBahanBaku->formulirPemesanan->kode_pemesanan_bahan_baku }}</td>
                        <td>{{ $item->nama_pengirim }}</td>
                        <td>{{ $item->nama_bank_penerima }}</td>
                        <td class="text-center">
                            <span class="badge bg-{{ $item->status === 'lunas' ? 'success' : 'warning' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                <i class="fas fa-image"></i>
                            </a>
                        </td>
                        <td class="text-nowrap">
                            <a href="{{ route('employee.pembayaran.show', $item->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('employee.pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('employee.pembayaran.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection