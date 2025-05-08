@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pesanan Bahan Baku</h2>
    
    <!-- Tombol untuk mengarahkan ke halaman formulir pemesanan -->
    <a href="{{ route('customer.order.create') }}" class="btn btn-primary mb-3">Buat Pemesanan Baru</a>
    
    @if ($pesanans->isEmpty())
        <div class="alert alert-info">
            Anda belum memiliki pesanan.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pemesanan</th>
                    <th>Nama Bahan Baku</th>
                    <th>Status Pesanan</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanans as $index => $pesanan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pesanan->formulirPemesanan->kode_pemesanan_bahan_baku }}</td>
                    <td>{{ $pesanan->formulirPemesanan->nama_bahan_baku }}</td>
                    <td>{{ $pesanan->status }}</td>
                    <td>{{ $pesanan->formulirPemesanan->total_harga }}</td>
                    <td>
                        <a href="{{ route('customer.order.show', $pesanan->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('customer.order.paymentStatus', $pesanan->id) }}" class="btn btn-success btn-sm">Status Pembayaran</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection