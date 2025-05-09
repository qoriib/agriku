@extends('layouts.app')

@section('title', 'Daftar Stok Barang')

@section('content')
<h4 class="mb-4 d-flex justify-content-between">
    <span>Daftar Stok Barang</span>
    <a href="{{ route('employee.persediaan.riwayat') }}" class="btn btn-secondary btn-sm">
        Lihat Riwayat
    </a>
</h4>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light text-center">
            <tr>
                <th>No</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Jumlah Persediaan</th>
                <th>Satuan</th>
                <th>Gudang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stokData as $index => $data)
            @php $barcode = $data['barcode']; @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="font-monospace text-center">{{ $barcode->kode_produk }}</td>
                <td>{{ $barcode->nama_produk }}</td>
                <td>{{ ucwords($barcode->kategori_produk) }}</td>
                <td class="font-monospace text-end">{{ $data['qty_sisa'] }}</td>
                <td>{{ $barcode->satuan }}</td>
                <td class="text-center">
                    @php
                        $gudang = $barcode->gudang;
                        $gudangLabel = match($gudang) {
                            'gudang1' => 'Gudang 1',
                            'gudang2' => 'Gudang 2',
                            'gudang3' => 'Gudang 3',
                            default => ucfirst($gudang)
                        };
                        $gudangBadge = match($gudang) {
                            'gudang1' => 'dark',
                            'gudang2' => 'secondary',
                            'gudang3' => 'warning',
                            default => 'light'
                        };
                    @endphp
                    <span class="badge bg-{{ $gudangBadge }}">{{ $gudangLabel }}</span>
                </td>
                <td class="text-center">
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalRiwayat{{ $barcode->id }}">
                        <i class="fas fa-eye"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@foreach($stokData as $data)
@php
    $barcode = $data['barcode'];
    $riwayat = $barcode->persediaans()->orderByDesc('tanggal')->orderByDesc('id')->get();
@endphp
<div class="modal fade" id="modalRiwayat{{ $barcode->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $barcode->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $barcode->id }}">Riwayat Persediaan: {{ $barcode->nama_produk }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                @if ($riwayat->isEmpty())
                    <div class="text-muted">Belum ada riwayat persediaan.</div>
                @else
                <div class="table-responsive">
                    <table class="table table-sm table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Tipe</th>
                                <th>Qty</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $i => $item)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $item->tipe === 'masuk' ? 'success' : 'danger' }}">
                                        {{ ucfirst($item->tipe) }}
                                    </span>
                                </td>
                                <td class="font-monospace text-end">{{ $item->qty_produk }}</td>
                                <td class="font-monospace text-center">{{ $item->tanggal }}</td>
                                <td class="font-monospace text-end">{{ $item->qty_sisa }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach