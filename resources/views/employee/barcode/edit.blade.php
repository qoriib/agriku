@extends('layouts.app')

@section('title', 'Edit Barcode')

@section('content')
    <h4 class="mb-4">Form Edit Barcode</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('employee.barcode.update', $barcode->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="vstack gap-3">
                    <div>
                        <label class="form-label">Kode Produk</label>
                        <input type="text" name="kode_produk" class="form-control" value="{{ old('kode_produk', $barcode->kode_produk) }}" required>
                    </div>
                    <div>
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk', $barcode->nama_produk) }}" required>
                    </div>
                    <div>
                        <label class="form-label">Satuan</label>
                        <select name="satuan" class="form-select" required>
                            <option value="Karung (30kg)" {{ old('satuan', $barcode->satuan) == 'Karung (30kg)' ? 'selected' : '' }} selected>Karung (30kg)</option>
                            <option value="Karung (50kg)" {{ old('satuan', $barcode->satuan) == 'Karung (50kg)' ? 'selected' : '' }}>Karung (50kg)</option>
                            <option value="PCS" {{ old('satuan', $barcode->satuan) == 'PCS' ? 'selected' : '' }}>PCS</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Kategori Produk</label>
                        <select name="kategori_produk" class="form-select" required>
                            <option value="barang jadi" {{ old('kategori_produk', $barcode->kategori_produk) == 'barang jadi' ? 'selected' : '' }}>Barang Jadi</option>
                            <option value="bahan baku" {{ old('kategori_produk', $barcode->kategori_produk) == 'bahan baku' ? 'selected' : '' }}>Bahan Baku</option>
                            <option value="bahan pendukung" {{ old('kategori_produk', $barcode->kategori_produk) == 'bahan pendukung' ? 'selected' : '' }}>Bahan Pendukung</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Gudang</label>
                        <select name="gudang" class="form-select" required>
                            <option value="gudang1" {{ old('gudang', $barcode->gudang) == 'gudang1' ? 'selected' : '' }}>Gudang 1</option>
                            <option value="gudang2" {{ old('gudang', $barcode->gudang) == 'gudang2' ? 'selected' : '' }}>Gudang 2</option>
                            <option value="gudang3" {{ old('gudang', $barcode->gudang) == 'gudang3' ? 'selected' : '' }}>Gudang 3</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('employee.barcode.index') }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-primary">Perbarui</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection