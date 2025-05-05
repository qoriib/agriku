@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Karyawan</h4>
    <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary">Tambah Karyawan</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>No. Telp</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($karyawans as $karyawan)
            <tr>
                <td>{{ $karyawan->nip }}</td>
                <td>{{ $karyawan->user->name }}</td>
                <td>{{ $karyawan->user->email }}</td>
                <td>{{ $karyawan->jabatan }}</td>
                <td>{{ $karyawan->no_telp }}</td>
                <td>
                    <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus karyawan ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
