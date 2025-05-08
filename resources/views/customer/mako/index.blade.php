@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pesanan Mako</h2>
    
    <a href="{{ route('customer.mako.create') }}" class="btn btn-primary mb-3">Buat Pesanan Baru</a>

    @if ($pesanans->isEmpty())
        <div class="alert alert-info">
            Anda belum memiliki pesanan.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Mako</th>
                    <th>Status Pesanan</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanans as $index => $pesanan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pesanan->formulirPemesananMako->jenis_mako }}</td>
                    <td>{{ $pesanan->status }}</td>
                    <td>{{ $pesanan->formulirPemesananMako->total_harga }}</td>
                    <td>
                        <a href="{{ route('customer.mako.show', $pesanan->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('customer.mako.edit', $pesanan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('customer.mako.destroy', $pesanan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection