@extends('layouts.app')

@section('title', 'Daftar Karyawan')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Daftar Karyawan</h4>
        <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary btn-sm">
            Tambah Karyawan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($karyawans->isEmpty())
        <div class="alert alert-info">Belum ada data karyawan.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th style="min-width: 10rem">Nama</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawans as $index => $karyawan)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $karyawan->user->name }}</td>
                        <td class="font-monospace text-nowrap">{{ $karyawan->user->email }}</td>
                        <td class="font-monospace text-nowrap">{{ $karyawan->no_telp }}</td>
                        <td class="text-capitalize">{{ str_replace('_', ' ', $karyawan->user->role) }}</td>
                        <td class="text-nowrap text-center">
                            <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection