@extends('layouts.admin')

@section('content')
<h4>Tambah Karyawan</h4>
<form method="POST" action="{{ route('admin.karyawan.store') }}">
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
        <label>NIP</label>
        <input type="text" name="nip" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Jabatan</label>
        <select name="jabatan" class="form-control" required>
            <option value="">-- Pilih --</option>
            @foreach(['kepala_divisi', 'staf_pengadaan', 'staf_produksi', 'staf_logistik'] as $jab)
                <option value="{{ $jab }}">{{ ucwords(str_replace('_', ' ', $jab)) }}</option>
            @endforeach
        </select>
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
    <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
