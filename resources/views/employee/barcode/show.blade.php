@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Barcode</h2>

    <table class="table">
        <tr><th>Kode Produk</th><td>{{ $barcode->kode_produk }}</td></tr>
        <tr><th>Nama Produk</th><td>{{ $barcode->nama_produk }}</td></tr>
        <tr><th>Satuan</th><td>{{ $barcode->satuan }}</td></tr>
        <tr><th>Kategori Produk</th><td>{{ $barcode->kategori_produk }}</td></tr>
        <tr><th>Gudang</th><td>{{ $barcode->gudang }}</td></tr>
        <tr><th>Dibuat</th><td>{{ $barcode->created_at->format('d M Y') }}</td></tr>
    </table>

    <a href="{{ route('employee.barcode.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection