@extends('layouts.app')

@section('title', 'Edit Pesanan Bahan Baku')

@section('content')
    <h4 class="mb-4">Form Edit Pesanan Bahan Baku</h4>

    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('employee.pengadaan.update', $pesanan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="vstack gap-3">
                    <div>
                        <label class="form-label">Kode Pemesanan</label>
                        <input type="text" name="kode_pemesanan_bahan_baku" class="form-control" value="{{ $pesanan->formulirPemesanan->kode_pemesanan_bahan_baku }}" required>
                    </div>

                    <div>
                        <label class="form-label">Nama Bahan Baku</label>
                        <input type="text" name="nama_bahan_baku" class="form-control" value="{{ $pesanan->formulirPemesanan->nama_bahan_baku }}" required>
                    </div>

                    <div>
                        <label class="form-label">Jumlah (Qty)</label>
                        <input type="number" name="qty" class="form-control" value="{{ $pesanan->formulirPemesanan->qty }}" required>
                    </div>

                    <div>
                        <label class="form-label">Tanggal Pemesanan</label>
                        <input type="date" name="tanggal_pemesanan" class="form-control" value="{{ $pesanan->formulirPemesanan->tanggal_pemesanan }}" required>
                    </div>

                    <div>
                        <label class="form-label">Alamat Pengiriman</label>
                        <textarea name="alamat_pengiriman" class="form-control" rows="3" required>{{ $pesanan->formulirPemesanan->alamat_pengiriman }}</textarea>
                    </div>

                    <div>
                        <label class="form-label">Harga Satuan</label>
                        <input type="number" name="harga" class="form-control" value="{{ $pesanan->formulirPemesanan->harga }}" required>
                    </div>

                    <div>
                        <label class="form-label">Pajak</label>
                        <input type="number" name="pajak" class="form-control" value="{{ $pesanan->formulirPemesanan->pajak }}" required>
                    </div>

                    <div>
                        <label class="form-label">Pemasok</label>
                        <select name="id_pemasok" class="form-select" required>
                            <option value="">-- Pilih Pemasok --</option>
                            @foreach($pemasoks as $pemasok)
                                <option value="{{ $pemasok->id }}" {{ $pesanan->formulirPemesanan->id_pemasok == $pemasok->id ? 'selected' : '' }}>
                                    {{ $pemasok->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Perbarui Pesanan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection