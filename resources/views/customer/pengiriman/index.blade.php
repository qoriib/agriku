@extends('layouts.app')

@section('title', 'Tracking Pengiriman Mako')

@section('content')
<h4 class="mb-4">Tracking Pengiriman Mako</h4>

@if ($pengirimans->isEmpty())
    <div class="alert alert-info">Belum ada pengiriman mako.</div>
@else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Jenis Mako</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Estimasi Sampai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengirimans as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ ucfirst($item->pesananMako->formulirPemesananMako->jenis_mako) }}</td>
                    <td class="font-monospace text-center">{{ $item->pesananMako->formulirPemesananMako->tanggal_pemesanan }}</td>
                    <td>{{ $item->estimasi_sampai }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ match($item->status) {
                            'dikirim' => 'warning',
                            'terlambat' => 'danger',
                            'diterima' => 'success',
                            default => 'secondary'
                        } }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="hstack gap-1">
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            @if ($item->status === 'dikirim')
                                <a href="{{ route('customer.pengiriman.konfirmasi.form', $item->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

{{-- Modal --}}
@foreach ($pengirimans as $item)
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pengiriman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-sm-5">Jenis Mako</dt>
                    <dd class="col-sm-7 text-capitalize">{{ $item->pesananMako->formulirPemesananMako->jenis_mako }}</dd>

                    <dt class="col-sm-5">Tanggal Pemesanan</dt>
                    <dd class="col-sm-7">{{ $item->pesananMako->formulirPemesananMako->tanggal_pemesanan }}</dd>

                    <dt class="col-sm-5">Jumlah</dt>
                    <dd class="col-sm-7">{{ $item->pesananMako->formulirPemesananMako->qty }}</dd>

                    <dt class="col-sm-5">Estimasi Sampai</dt>
                    <dd class="col-sm-7">{{ $item->estimasi_sampai }}</dd>

                    <dt class="col-sm-5">Status</dt>
                    <dd class="col-sm-7">
                        <span class="badge bg-{{ match($item->status) {
                            'dikirim' => 'warning',
                            'terlambat' => 'danger',
                            'diterima' => 'success',
                            default => 'secondary'
                        } }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </dd>

                    <dt class="col-sm-5">Karyawan Logistik</dt>
                    <dd class="col-sm-7">{{ $item->karyawan->user->name ?? '-' }}</dd>

                    <dt class="col-sm-5">Bukti Dikirim</dt>
                    <dd class="col-sm-7">
                        @if ($item->bukti_pesanan_diterima)
                            <a href="{{ asset('storage/' . $item->bukti_pesanan_diterima) }}" target="_blank">
                                <img src="{{ asset('storage/' . $item->bukti_pesanan_diterima) }}" alt="Bukti Pengiriman" class="img-fluid img-thumbnail" style="max-height: 200px;">
                            </a>
                        @else
                            <span class="text-muted">Belum tersedia</span>
                        @endif
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection