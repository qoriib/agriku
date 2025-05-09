@extends('layouts.app')

@section('title', 'Edit Transaksi Persediaan')

@section('content')
    <h4 class="mb-4">Form Edit Transaksi Persediaan</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('employee.persediaan.update', $persediaan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="vstack gap-3">
                    <div>
                        <label class="form-label">Produk</label>
                        <select name="id_barcode" class="form-select" required>
                            <option disabled selected>Pilih produk</option>
                            @foreach($barcodes as $barcode)
                                <option value="{{ $barcode->id }}" {{ $barcode->id == old('id_barcode', $persediaan->id_barcode) ? 'selected' : '' }}>
                                    {{ $barcode->nama_produk }} ({{ $barcode->kode_produk }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Tipe Transaksi</label>
                        <select name="tipe" class="form-select" required>
                            <option value="masuk" {{ old('tipe', $persediaan->tipe) == 'masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="keluar" {{ old('tipe', $persediaan->tipe) == 'keluar' ? 'selected' : '' }}>Keluar</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Jumlah Produk</label>
                        <input type="number" name="qty_produk" class="form-control" min="1" value="{{ old('qty_produk', $persediaan->qty_produk) }}" required>
                    </div>

                    <div>
                        <label class="form-label">Tanggal Transaksi</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $persediaan->tanggal) }}" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('employee.persediaan.riwayat') }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection