@extends('layouts.app')

@section('title', 'Edit Pemasok')

@section('content')
<h4>Edit Pemasok</h4>
<form method="POST" action="{{ route('admin.pemasok.update', $pemasok->id) }}">
    @csrf @method('PUT')
    <div class="row mb-3">
        <div class="col">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $pemasok->user->name }}" class="form-control" required>
        </div>
        <div class="col">
            <label>Email</label>
            <input type="email" name="email" value="{{ $pemasok->user->email }}" class="form-control" required>
        </div>
    </div>
    <div class="mb-3">
        <label>No. Telp</label>
        <input type="text" name="no_telp" value="{{ $pemasok->no_telp }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control">{{ $pemasok->alamat }}</textarea>
    </div>
    <button class="btn btn-success">Update</button>
    <a href="{{ route('admin.pemasok.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
