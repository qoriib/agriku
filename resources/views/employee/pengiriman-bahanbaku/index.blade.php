@extends('layouts.app')

@section('title', 'Pengiriman Bahan Baku')

@section('content')
<h4 class="mb-4">Daftar Pengiriman Bahan Baku</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light text-center">
            <tr>
                <th>No</th>
                <th>Kode Pesanan</th>
                <th>Pemasok</th>
                <th>Estimasi Sampai</th>
                <th>Bukti</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengirimen as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="font-monospace">{{ $item->pesananBahanBaku->formulirPemesanan->kode_pemesanan_bahan_baku }}</td>
                <td>{{ $item->pemasok->nama_perusahaan }}</td>
                <td class="text-center">{{ $item->estimasi_sampai }}</td>
                <td class="text-center">
                    @if($item->bukti_pengiriman)
                        <a href="{{ asset('storage/' . $item->bukti_pengiriman) }}" target="_blank" class="btn btn-sm btn-outline-dark">
                            <i class="fas fa-file-alt"></i>
                        </a>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td class="text-center">
                    <form action="{{ route('employee.pengiriman-bahanbaku.updateStatus', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="dikirim" {{ $item->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="diterima" {{ $item->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        </select>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Belum ada pengiriman bahan baku.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection