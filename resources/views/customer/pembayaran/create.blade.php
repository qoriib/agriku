@extends('layouts.app')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
    <h4 class="mb-4">Upload Bukti Pembayaran</h4>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customer.pembayaran.store', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="vstack gap-3">

                    <div>
                        <label class="form-label">No Rekening Penerima</label>
                        <input type="text" name="no_rekening_penerima" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Nama Bank Penerima</label>
                        <input type="text" name="nama_bank_penerima" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Nama Penerima</label>
                        <input type="text" name="nama_penerima" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Cara Pembayaran</label>
                        <select name="cara_pembayaran" class="form-select" required>
                            <option value="transfer">Transfer</option>
                            <option value="tunai">Tunai</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Nama Pengirim</label>
                        <input type="text" name="nama_pengirim" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Nama Bank Pengirim</label>
                        <input type="text" name="nama_bank_pengirim" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Bukti Pembayaran (jpg/png)</label>
                        <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('customer.mako.index') }}" class="btn btn-outline-secondary">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Kirim Pembayaran
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection