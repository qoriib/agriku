@extends('layouts.app')

@section('title', 'Tambah Pemasok')

@section('content')
    <h4 class="mb-4">Form Tambah Pemasok</h4>

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
            <form method="POST" action="{{ route('admin.pemasok.store') }}">
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
                        <label class="form-label">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan') }}" required>
                    </div>

                    <div>
                        <label class="form-label">Bahan Baku</label>
                        <input type="text" name="bahan_baku" class="form-control" value="{{ old('bahan_baku') }}" required>
                    </div>

                    <div>
                        <label class="form-label">No. Telp</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.pemasok.index') }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection