@extends('layouts.app')

@section('title', 'Daftar Order Mako')

@section('content')
    <div class="hstack align-items-center justify-content-between gap-2 mb-4">
        <h2 class="h4 flex-grow-1 mb-0">Daftar Order Mako</h2>
        <a href="{{ route('employee.order.print') }}" class="btn btn-secondary btn-sm">Print</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info">Belum ada order mako.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Konsumen</th>
                        <th>Jenis Mako</th>
                        <th>Jumlah</th>
                        <th>Alamat</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Status Produksi</th>
                        <th>Status Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $index => $order)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $order->konsumen->user->name ?? '-' }}</td>
                        <td>{{ $order->formulirPemesananMako->jenis_mako ?? '-' }}</td>
                        <td class="text-center">{{ $order->formulirPemesananMako->qty ?? '-' }}</td>
                        <td>{{ $order->formulirPemesananMako->alamat_pengiriman ?? '-' }}</td>
                        <td class="text-center font-monospace text-nowrap">{{ $order->formulirPemesananMako->tanggal_pemesanan ?? '-' }}</td>
                        <td class="font-monospace text-end">
                            Rp {{ number_format($order->formulirPemesananMako->total_harga ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $order->status === 'diterima' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($order->pengirimanMako)
                                <span class="badge bg-{{ $order->pengirimanMako->status === 'diterima' ? 'success' : 'info' }}">
                                    {{ ucfirst($order->pengirimanMako->status) }}
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Belum dikirim
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection