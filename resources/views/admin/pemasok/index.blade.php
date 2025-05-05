@extends('layouts.admin')

@section('title', 'Data Pemasok')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Pemasok</h4>
    <a href="{{ route('admin.pemasok.create') }}" class="btn btn-primary">Tambah Pemasok</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>No. Telp</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pemasoks as $pemasok)
            <tr>
                <td>{{ $pemasok->user->name }}</td>
                <td>{{ $pemasok->user->email }}</td>
                <td>{{ $pemasok->no_telp }}</td>
                <td>{{ $pemasok->alamat }}</td>
                <td>
                    <a href="{{ route('admin.pemasok.edit', $pemasok->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.pemasok.destroy', $pemasok->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pemasok ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
