@extends('layouts.app')

@section('title', 'Edit Pemasok')

@section('content')
    <h4 class="mb-4">Form Edit Pemasok</h4>

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
            <form method="POST" action="{{ route('admin.pemasok.update', $pemasok->id) }}">
                @csrf
                @method('PUT')

                <div class="vstack gap-3">
                    <div>
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $pemasok->user->name) }}" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $pemasok->user->email) }}" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $pemasok->nama_perusahaan) }}" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Bahan Baku</label>
                        <input type="text" name="bahan_baku" value="{{ old('bahan_baku', $pemasok->bahan_baku) }}" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">No. Telp</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp', $pemasok->no_telp) }}" class="form-control">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.pemasok.index') }}" class="btn btn-secondary">Batal</a>
                        <button class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection