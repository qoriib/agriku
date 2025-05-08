@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Barcode Produk</h2>

    <a href="{{ route('employee.barcode.create') }}" class="btn btn-primary mb-3">Tambah Barcode</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Kategori</th>
                <th>Gudang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barcodes as $barcode)
            <tr>
                <td>{{ $barcode->kode_produk }}</td>
                <td>{{ $barcode->nama_produk }}</td>
                <td>{{ $barcode->satuan }}</td>
                <td>{{ $barcode->kategori_produk }}</td>
                <td>{{ $barcode->gudang }}</td>
                <td>
                    <a href="{{ route('employee.barcode.show', $barcode->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('employee.barcode.edit', $barcode->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('employee.barcode.destroy', $barcode->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
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