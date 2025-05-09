@extends('layouts.app')

@section('title', 'Edit Pengiriman')

@section('content')
<h4 class="mb-4">Edit Pengiriman</h4>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('supplier.pengiriman.update', $pengiriman->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="vstack gap-3">
                <div>
                    <label class="form-label">Status Pengiriman</label>
                    <select name="status" class="form-select" required>
                        <option value="dikirim" {{ $pengiriman->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="diterima" {{ $pengiriman->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Bukti Pengiriman</label>
                    <input type="file" name="bukti_pengiriman" class="form-control" accept="image/*">
                    @if ($pengiriman->bukti_pengiriman)
                        <small class="text-muted d-block mt-1">Saat ini: <a href="{{ asset('storage/' . $pengiriman->bukti_pengiriman) }}" target="_blank">Lihat</a></small>
                    @endif
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('supplier.pengiriman.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection