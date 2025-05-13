@extends('layouts.app')

@section('title', 'Riwayat Persediaan - ' . $barcode->nama_produk)

@section('content')
<h4 class="mb-4 d-flex justify-content-between align-items-center">
    <span>Riwayat Persediaan: <strong>{{ $barcode->nama_produk }}</strong></span>
    <div class="d-flex gap-2">
        <a href="{{ route('employee.barcode.index') }}" class="btn btn-secondary btn-sm">
            Kembali
        </a>
    </div>
</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($barcode->persediaans->isEmpty())
    <div class="alert alert-info">Belum ada riwayat persediaan untuk produk ini.</div>
@else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Tipe</th>
                    <th>Qty</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barcode->persediaans as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $barcode->nama_produk }}</td>
                    <td>
                        <span class="badge bg-{{ $item->tipe === 'masuk' ? 'success' : 'danger' }}">
                            {{ ucfirst($item->tipe) }}
                        </span>
                    </td>
                    <td class="font-monospace text-end">{{ $item->qty_produk }}</td>
                    <td class="font-monospace text-center">{{ $item->tanggal }}</td>
                    <td class="font-monospace text-end">{{ $item->qty_sisa }}</td>
                    <td class="text-nowrap text-center">
                        <a href="{{ route('employee.persediaan.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('employee.persediaan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="Hapus">
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