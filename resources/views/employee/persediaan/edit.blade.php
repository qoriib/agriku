@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Transaksi Persediaan</h2>

    <form action="{{ route('employee.persediaan.update', $persediaan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Produk</label>
            <select name="id_barcode" class="form-control" required>
                @foreach($barcodes as $barcode)
                    <option value="{{ $barcode->id }}" {{ $barcode->id == $persediaan->id_barcode ? 'selected' : '' }}>
                        {{ $barcode->nama_produk }} ({{ $barcode->kode_produk }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tipe</label>
            <select name="tipe" class="form-control" required>
                <option value="masuk" {{ $persediaan->tipe == 'masuk' ? 'selected' : '' }}>Masuk</option>
                <option value="keluar" {{ $persediaan->tipe == 'keluar' ? 'selected' : '' }}>Keluar</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Qty Produk</label>
            <input type="number" name="qty_produk" class="form-control" value="{{ $persediaan->qty_produk }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $persediaan->tanggal }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection