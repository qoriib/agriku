@extends('layouts.app')

@section('title', 'Edit Status Pembayaran')

@section('content')
<h4 class="mb-4">Edit Status Pembayaran</h4>

<div class="card">
    <div class="card-body">
        <form action="{{ route('supplier.pembayaran.update', $pembayaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Status Pembayaran</label>
                <select name="status" class="form-select" required>
                    <option value="menunggu pembayaran" {{ $pembayaran->status == 'menunggu pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="lunas" {{ $pembayaran->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('supplier.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection