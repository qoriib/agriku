@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat Persediaan</h2>

    <a href="{{ route('employee.persediaan.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Tipe</th>
                <th>Qty</th>
                <th>Qty Sisa</th>
                <th>Gudang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($persediaans as $p)
            <tr>
                <td>{{ $p->tanggal }}</td>
                <td>{{ $p->barcode->nama_produk }} ({{ $p->barcode->kode_produk }})</td>
                <td>
                    <span class="badge bg-{{ $p->tipe == 'masuk' ? 'success' : 'danger' }}">{{ ucfirst($p->tipe) }}</span>
                </td>
                <td>{{ $p->qty_produk }}</td>
                <td>{{ $p->qty_sisa }}</td>
                <td>{{ $p->barcode->gudang }}</td>
                <td>
                    <a href="{{ route('employee.persediaan.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('employee.persediaan.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
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