@extends('layouts.app')

@section('title', 'Tambah Barcode')

@section('content')
    <h4 class="mb-4">Form Tambah Barcode</h4>

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
            <form action="{{ route('employee.barcode.store') }}" method="POST">
                @csrf
                <div class="vstack gap-3">
                    <div>
                        <label class="form-label">Kode Produk</label>
                        <input type="text" name="kode_produk" class="form-control" value="{{ old('kode_produk') }}" required>
                    </div>
                    <div>
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk') }}" required>
                    </div>
                    <div>
                        <label class="form-label">Satuan</label>
                        <select name="satuan" class="form-select" required>
                            <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }} selected>Kilogram (kg)</option>
                            <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>Liter</option>
                            <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Kategori Produk</label>
                        <select name="kategori_produk" class="form-select" required>
                            <option value="barang jadi" {{ old('kategori_produk') == 'barang jadi' ? 'selected' : '' }} selected>Barang Jadi</option>
                            <option value="bahan baku" {{ old('kategori_produk') == 'bahan baku' ? 'selected' : '' }}>Bahan Baku</option>
                            <option value="bahan pendukung" {{ old('kategori_produk') == 'bahan pendukung' ? 'selected' : '' }}>Bahan Pendukung</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Gudang</label>
                        <select name="gudang" class="form-select" required>
                            <option disabled >Pilih gudang/option>
                            <option value="gudang1" {{ old('gudang') == 'gudang1' ? 'selected' : '' }} selected>Gudang 1</option>
                            <option value="gudang2" {{ old('gudang') == 'gudang2' ? 'selected' : '' }}>Gudang 2</option>
                            <option value="gudang3" {{ old('gudang') == 'gudang3' ? 'selected' : '' }}>Gudang 3</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('employee.barcode.index') }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection