@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Formulir Pemesanan Mako</h2>
    
    <form action="{{ route('customer.mako.store') }}" method="POST">
        @csrf
        
        <!-- Jenis Mako -->
        <div class="mb-3">
            <label for="jenis_mako" class="form-label">Jenis Mako</label>
            <select class="form-select" name="jenis_mako" required>
                <option value="raskin">Raskin</option>
                <option value="premium">Premium</option>
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="qty" class="form-label">Jumlah (Qty)</label>
            <input type="number" class="form-control" id="qty" name="qty" required>
        </div>

        <!-- Tanggal Pemesanan -->
        <div class="mb-3">
            <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
            <input type="date" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" required>
        </div>

        <!-- Alamat Pengiriman -->
        <div class="mb-3">
            <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
            <textarea class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" rows="3" required></textarea>
        </div>

        <!-- Harga -->
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>

        <!-- Pajak -->
        <div class="mb-3">
            <label for="pajak" class="form-label">Pajak</label>
            <input type="number" class="form-control" id="pajak" name="pajak" required>
        </div>

        <!-- Pemasok -->
        <div class="mb-3">
            <label for="id_pemasok" class="form-label">Pemasok</label>
            <select class="form-select" id="id_pemasok" name="id_pemasok" required>
                <option value="">Pilih Pemasok</option>
                @foreach($pemasoks as $pemasok)
                    <option value="{{ $pemasok->id }}">{{ $pemasok->nama_perusahaan }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pemesanan</button>
    </form>
</div>
@endsection