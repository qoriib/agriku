@extends('layouts.app')

@section('title', 'Tambah Pesanan Bahan Baku')

@section('content')
    <h4 class="mb-4">Form Tambah Pesanan Bahan Baku</h4>

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

            <form action="{{ route('employee.pengadaan.store') }}" method="POST">
                @csrf

                <div class="vstack gap-3">
                    <div>
                        <label class="form-label">Kode Pemesanan</label>
                        <input type="text" name="kode_pemesanan_bahan_baku" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Nama Bahan Baku</label>
                        <input type="text" name="nama_bahan_baku" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Jumlah (Qty)</label>
                        <input type="number" name="qty" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Tanggal Pemesanan</label>
                        <input type="date" name="tanggal_pemesanan" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Alamat Pengiriman</label>
                        <textarea name="alamat_pengiriman" class="form-control" rows="3" required></textarea>
                    </div>

                    <div>
                        <label class="form-label">Harga Satuan</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Pajak</label>
                        <input type="number" name="pajak" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Pemasok</label>
                        <select name="id_pemasok" class="form-select" required>
                            <option value="">-- Pilih Pemasok --</option>
                            @foreach($pemasoks as $pemasok)
                                <option value="{{ $pemasok->id }}">{{ $pemasok->nama_perusahaan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection