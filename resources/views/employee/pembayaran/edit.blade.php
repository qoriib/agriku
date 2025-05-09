@extends('layouts.app')

@section('title', 'Edit Pembayaran Bahan Baku')

@section('content')
<h4 class="mb-4">Form Edit Pembayaran Bahan Baku</h4>

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
        <form action="{{ route('employee.pembayaran.update', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="vstack gap-3">
                <div>
                    <label class="form-label">No Rekening Penerima</label>
                    <input type="text" name="no_rekening_penerima" class="form-control" value="{{ old('no_rekening_penerima', $pembayaran->no_rekening_penerima) }}" required>
                </div>

                <div>
                    <label class="form-label">Nama Bank Penerima</label>
                    <input type="text" name="nama_bank_penerima" class="form-control" value="{{ old('nama_bank_penerima', $pembayaran->nama_bank_penerima) }}" required>
                </div>

                <div>
                    <label class="form-label">Nama Pengirim</label>
                    <input type="text" name="nama_pengirim" class="form-control" value="{{ old('nama_pengirim', $pembayaran->nama_pengirim) }}" required>
                </div>

                <div>
                    <label class="form-label">Nama Bank Pengirim</label>
                    <input type="text" name="nama_bank_pengirim" class="form-control" value="{{ old('nama_bank_pengirim', $pembayaran->nama_bank_pengirim) }}" required>
                </div>

                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="menunggu pembayaran" {{ $pembayaran->status === 'menunggu pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                        <option value="lunas" {{ $pembayaran->status === 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Bukti Pembayaran</label><br>
                    @if ($pembayaran->bukti_pembayaran)
                        <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">
                            <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-thumbnail mb-2" style="max-height: 150px;">
                        </a>
                    @endif
                    <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*,.pdf">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti.</small>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('employee.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection