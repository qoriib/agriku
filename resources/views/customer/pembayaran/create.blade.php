@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upload Bukti Pembayaran</h1>

    <form action="{{ route('customer.pembayaran.store', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>No Rekening Penerima</label>
            <input type="text" name="no_rekening_penerima" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Bank Penerima</label>
            <input type="text" name="nama_bank_penerima" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Penerima</label>
            <input type="text" name="nama_penerima" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Cara Pembayaran</label>
            <select name="cara_pembayaran" class="form-control" required>
                <option value="transfer">Transfer</option>
                <option value="tunai">Tunai</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Pengirim</label>
            <input type="text" name="nama_pengirim" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Bank Pengirim</label>
            <input type="text" name="nama_bank_pengirim" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Bukti Pembayaran (jpg, png)</label>
            <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*" required>
        </div>

        <button class="btn btn-primary">Kirim Pembayaran</button>
    </form>
</div>
@endsection