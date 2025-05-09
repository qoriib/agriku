@extends('layouts.app')

@section('title', 'Manajemen Pesanan Mako')

@section('content')
    <h4 class="mb-4">Manajemen Pesanan Mako</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Konsumen</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanans as $index => $pesanan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        {{ $pesanan->konsumen->user->name ?? '-' }}<br>
                        <small class="text-muted">{{ $pesanan->konsumen->user->email ?? '' }}</small>
                    </td>
                    <td class="text-capitalize">{{ $pesanan->formulirPemesananMako->jenis_mako }}</td>
                    <td class="text-center">
                        <form action="{{ route('divisi.pesanan.update', $pesanan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="menunggu" {{ $pesanan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diterima" {{ $pesanan->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            </select>
                        </form>
                    </td>
                    <td class="font-monospace">Rp {{ number_format($pesanan->formulirPemesananMako->total_harga, 0, ',', '.') }}</td>
                    <td class="text-nowrap">
                        <div class="hstack gap-1">
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $pesanan->id }}">
                                <i class="fas fa-eye"></i>
                            </button>

                            <form action="{{ route('divisi.pesanan.destroy', $pesanan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    @foreach ($pesanans as $pesanan)
    <div class="modal fade" id="modalDetail{{ $pesanan->id }}" tabindex="-1" aria-labelledby="label{{ $pesanan->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pesanan Mako</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Konsumen</dt>
                        <dd class="col-sm-7">{{ $pesanan->konsumen->user->name }}</dd>

                        <dt class="col-sm-5">Email</dt>
                        <dd class="col-sm-7">{{ $pesanan->konsumen->user->email }}</dd>

                        <dt class="col-sm-5">Jenis Mako</dt>
                        <dd class="col-sm-7 text-capitalize">{{ $pesanan->formulirPemesananMako->jenis_mako }}</dd>

                        <dt class="col-sm-5">Jumlah</dt>
                        <dd class="col-sm-7">{{ $pesanan->formulirPemesananMako->qty }}</dd>

                        <dt class="col-sm-5">Harga Satuan</dt>
                        <dd class="col-sm-7 font-monospace">Rp {{ number_format($pesanan->formulirPemesananMako->harga, 0, ',', '.') }}</dd>

                        <dt class="col-sm-5">Total Harga</dt>
                        <dd class="col-sm-7 font-monospace">Rp {{ number_format($pesanan->formulirPemesananMako->total_harga, 0, ',', '.') }}</dd>

                        <dt class="col-sm-5">Tanggal</dt>
                        <dd class="col-sm-7">{{ $pesanan->formulirPemesananMako->tanggal_pemesanan }}</dd>

                        <dt class="col-sm-5">Alamat</dt>
                        <dd class="col-sm-7">{{ $pesanan->formulirPemesananMako->alamat_pengiriman }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection