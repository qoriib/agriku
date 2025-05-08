@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Transaksi Persediaan</h2>

    <form action="{{ route('employee.persediaan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Produk</label>
            <select name="id_barcode" class="form-control" required>
                @foreach($barcodes as $barcode)
                    <option value="{{ $barcode->id }}">{{ $barcode->nama_produk }} ({{ $barcode->kode_produk }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tipe</label>
            <select name="tipe" class="form-control" required>
                <option value="masuk">Masuk</option>
                <option value="keluar">Keluar</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Qty Produk</label>
            <input type="number" name="qty_produk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Transaksi</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection