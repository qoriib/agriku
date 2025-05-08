@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Barcode</h2>

    <form action="{{ route('employee.barcode.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Kode Produk</label>
            <input type="text" name="kode_produk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Satuan</label>
            <input type="text" name="satuan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori Produk</label>
            <select name="kategori_produk" class="form-control" required>
                <option value="barang jadi">Barang Jadi</option>
                <option value="bahan baku">Bahan Baku</option>
                <option value="bahan pendukung">Bahan Pendukung</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Gudang</label>
            <select name="gudang" class="form-control" required>
                <option value="gudang1">Gudang 1</option>
                <option value="gudang2">Gudang 2</option>
                <option value="gudang3">Gudang 3</option>
            </select>
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection