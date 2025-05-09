@extends('layouts.app')

@section('title', 'Tambah Pemasok')

@section('content')
<h4>Tambah Pemasok</h4>
<form method="POST" action="{{ route('admin.pemasok.store') }}">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>No. Telp</label>
        <input type="text" name="no_telp" class="form-control">
    </div>
    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"></textarea>
    </div>
    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('admin.pemasok.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
