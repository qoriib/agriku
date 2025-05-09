@extends('layouts.app')

@section('title', 'Data Konsumen')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Konsumen</h4>
    <a href="{{ route('admin.konsumen.create') }}" class="btn btn-primary">Tambah Konsumen</a>
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
        @forelse ($konsumens as $konsumen)
            <tr>
                <td>{{ $konsumen->user->name }}</td>
                <td>{{ $konsumen->user->email }}</td>
                <td>{{ $konsumen->no_telp }}</td>
                <td>{{ $konsumen->alamat }}</td>
                <td>
                    <a href="{{ route('admin.konsumen.edit', $konsumen->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.konsumen.destroy', $konsumen->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus konsumen ini?')">
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
