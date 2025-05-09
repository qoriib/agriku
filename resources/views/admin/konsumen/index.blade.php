@extends('layouts.app')

@section('title', 'Data Konsumen')

@section('content')
    <h4 class="mb-4 d-flex justify-content-between align-items-center">
        <span>Daftar Konsumen</span>
        <a href="{{ route('admin.konsumen.create') }}" class="btn btn-primary btn-sm">
           Tambah Konsumen
        </a>
    </h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($konsumens->isEmpty())
        <div class="alert alert-info">Belum ada data konsumen.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($konsumens as $index => $konsumen)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $konsumen->user->name }}</td>
                            <td class="font-monospace">{{ $konsumen->user->email }}</td>
                            <td class="font-monospace text-nowrap">{{ $konsumen->no_telp }}</td>
                            <td>{{ $konsumen->alamat }}</td>
                            <td class="text-nowrap text-center">
                                <a href="{{ route('admin.konsumen.edit', $konsumen->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.konsumen.destroy', $konsumen->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus konsumen ini?')">
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