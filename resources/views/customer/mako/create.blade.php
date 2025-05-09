@extends('layouts.app')

@section('title', 'Formulir Pemesanan Mako')

@section('content')
<h4 class="mb-4">Formulir Pemesanan Mako</h4>

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
        <form action="{{ route('customer.mako.store') }}" method="POST">
            @csrf
            <div class="vstack gap-3">
                <div>
                    <label class="form-label">Jenis Mako</label>
                    <select class="form-select" name="jenis_mako" required>
                        <option value="raskin">Raskin</option>
                        <option value="premium">Premium</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Jumlah (Qty)</label>
                    <input type="number" name="qty" class="form-control" required>
                </div>
                <div>
                    <label class="form-label">Harga per Unit</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div>
                    <label class="form-label">Tanggal Pemesanan</label>
                    <input type="date" name="tanggal_pemesanan" class="form-control" required>
                </div>
                <div>
                    <label class="form-label">Alamat Pengiriman</label>
                    <textarea name="alamat_pengiriman" class="form-control" rows="3" required></textarea>
                </div>
                <div class="text-end">
                    <a href="{{ route('customer.mako.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Kirim Pemesanan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection