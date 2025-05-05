@extends('layouts.admin')

@section('content')
<h4>Edit Karyawan</h4>
<form method="POST" action="{{ route('admin.karyawan.update', $karyawan->id) }}">
    @csrf @method('PUT')

    <div class="row mb-3">
        <div class="col">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $karyawan->user->name }}" class="form-control" required>
        </div>
        <div class="col">
            <label>Email</label>
            <input type="email" name="email" value="{{ $karyawan->user->email }}" class="form-control" required>
        </div>
    </div>
    <div class="mb-3">
        <label>NIP</label>
        <input type="text" name="nip" value="{{ $karyawan->nip }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Jabatan</label>
        <select name="jabatan" class="form-control" required>
            @foreach(['kepala_divisi', 'staf_pengadaan', 'staf_produksi', 'staf_logistik'] as $jab)
                <option value="{{ $jab }}" {{ $karyawan->jabatan == $jab ? 'selected' : '' }}>
                    {{ ucwords(str_replace('_', ' ', $jab)) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>No. Telp</label>
        <input type="text" name="no_telp" value="{{ $karyawan->no_telp }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control">{{ $karyawan->alamat }}</textarea>
    </div>
    <button class="btn btn-success">Update</button>
    <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
