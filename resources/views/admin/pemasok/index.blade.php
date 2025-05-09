@extends('layouts.app')

@section('title', 'Data Pemasok')

@section('content')
    <h4 class="d-flex justify-content-between align-items-center mb-4">
        <span>Daftar Pemasok</span>
        <a href="{{ route('admin.pemasok.create') }}" class="btn btn-primary btn-sm">
            Tambah Pemasok
        </a>
    </h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($pemasoks->isEmpty())
        <div class="alert alert-info">Belum ada data pemasok.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Perusahaan</th>
                        <th>Bahan Baku</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemasoks as $index => $pemasok)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $pemasok->user->name }}</td>
                        <td class="font-monospace">{{ $pemasok->user->email }}</td>
                        <td>{{ $pemasok->nama_perusahaan }}</td>
                        <td>{{ $pemasok->bahan_baku }}</td>
                        <td>{{ $pemasok->no_telp }}</td>
                        <td class="text-nowrap text-center">
                            <a href="{{ route('admin.pemasok.edit', $pemasok->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pemasok.destroy', $pemasok->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pemasok ini?')">
                                @csrf @method('DELETE')
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