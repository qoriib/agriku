@extends('layouts.app')

@section('title', 'Riwayat Persediaan')

@section('content')
<h4 class="mb-4 d-flex justify-content-between">
    <span>Riwayat Persediaan Barang</span>
    <a href="{{ route('employee.persediaan.create') }}" class="btn btn-success btn-sm">
        Tambah Persediaan
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
                <th>Nama Produk</th>
                <th>Tipe</th>
                <th>Qty</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($persediaans as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->barcode->nama_produk ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $item->tipe === 'masuk' ? 'success' : 'danger' }}">
                        {{ ucfirst($item->tipe) }}
                    </span>
                </td>
                <td class="font-monospace text-end">{{ $item->qty_produk }}</td>
                <td class="font-monospace text-center">{{ $item->tanggal }}</td>
                <td class="font-monospace text-end">{{ $item->qty_sisa }}</td>
                <td class="text-nowrap text-center">
                    <a href="{{ route('employee.persediaan.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('employee.persediaan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" title="Hapus">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection