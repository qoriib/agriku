@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Barcode</h2>

    <form action="{{ route('employee.barcode.update', $barcode->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Kode Produk</label>
            <input type="text" name="kode_produk" class="form-control" value="{{ $barcode->kode_produk }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="{{ $barcode->nama_produk }}" required>
        </div>
        <div class="mb-3">
            <label>Satuan</label>
            <input type="text" name="satuan" class="form-control" value="{{ $barcode->satuan }}" required>
        </div>
        <div class="mb-3">
            <label>Kategori Produk</label>
            <select name="kategori_produk" class="form-control">
                <option value="barang jadi" {{ $barcode->kategori_produk == 'barang jadi' ? 'selected' : '' }}>Barang Jadi</option>
                <option value="bahan baku" {{ $barcode->kategori_produk == 'bahan baku' ? 'selected' : '' }}>Bahan Baku</option>
                <option value="bahan pendukung" {{ $barcode->kategori_produk == 'bahan pendukung' ? 'selected' : '' }}>Bahan Pendukung</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Gudang</label>
            <select name="gudang" class="form-control">
                <option value="gudang1" {{ $barcode->gudang == 'gudang1' ? 'selected' : '' }}>Gudang 1</option>
                <option value="gudang2" {{ $barcode->gudang == 'gudang2' ? 'selected' : '' }}>Gudang 2</option>
                <option value="gudang3" {{ $barcode->gudang == 'gudang3' ? 'selected' : '' }}>Gudang 3</option>
            </select>
        </div>
        <button class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection