@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Formulir Pemesanan Bahan Baku</h2>
    
    <!-- Form untuk membuat pemesanan bahan baku -->
    <form action="{{ route('customer.order.store') }}" method="POST">
        @csrf
        
        <!-- Kode Pemesanan -->
        <div class="mb-3">
            <label for="kode_pemesanan_bahan_baku" class="form-label">Kode Pemesanan</label>
            <input type="text" class="form-control" id="kode_pemesanan_bahan_baku" name="kode_pemesanan_bahan_baku" required>
        </div>
        
        <!-- Nama Bahan Baku -->
        <div class="mb-3">
            <label for="nama_bahan_baku" class="form-label">Nama Bahan Baku</label>
            <input type="text" class="form-control" id="nama_bahan_baku" name="nama_bahan_baku" required>
        </div>
        
        <!-- Jumlah (Qty) -->
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
                <!-- List Pemasok yang bisa dipilih -->
                @foreach($pemasoks as $pemasok)
                    <option value="{{ $pemasok->id }}">{{ $pemasok->nama_perusahaan }}</option>
                @endforeach
            </select>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Kirim Pemesanan</button>
    </form>
</div>
@endsection