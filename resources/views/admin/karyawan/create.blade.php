@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('content')
    <h4 class="mb-4">Form Tambah Karyawan</h4>

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
            <form method="POST" action="{{ route('admin.karyawan.store') }}">
                @csrf
                <div class="vstack gap-3">

                    <div>
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div>
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div>
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Jabatan</label>
                        <select name="jabatan" class="form-select" required>
                            <option disabled selected>-- Pilih Jabatan --</option>
                            @foreach(['kepala_divisi', 'staf_pengadaan', 'staf_produksi', 'staf_logistik'] as $jab)
                                <option value="{{ $jab }}" {{ old('jabatan') === $jab ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_', ' ', $jab)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="form-label">No. Telp</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-success">Simpan</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection