@extends('layouts.app')

@section('title', 'Daftar Barcode Produk')

@section('content')
    <div class="hstack align-items-center justify-content-between gap-2 mb-4">
        <h2 class="h4 flex-grow-1 mb-0">Daftar Barcode Produk</h2>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#scanBarcodeModal">Scan Barcode</button>
        <a href="{{ route('employee.barcode.create') }}" class="btn btn-success btn-sm">Tambah Barcode</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Gudang</th>
                    <th>Barcode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barcodes as $index => $barcode)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-monospace text-center">{{ $barcode->kode_produk }}</td>
                    <td>{{ $barcode->nama_produk }}</td>
                    <td>{{ $barcode->satuan }}</td>
                    <td>
                        @php
                            $kategori = $barcode->kategori_produk;
                            $kategoriBadge = match($kategori) {
                                'barang jadi' => 'primary',
                                'bahan baku' => 'success',
                                'bahan pendukung' => 'info',
                                default => 'secondary'
                            };
                        @endphp
                        <span class="badge bg-{{ $kategoriBadge }}">{{ ucwords($kategori) }}</span>
                    </td>
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
                        <svg class="barcode-svg" data-code="{{ $barcode->kode_produk }}"></svg>
                    </td>
                    <td class="text-nowrap">
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalBarcode{{ $barcode->id }}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <a href="{{ route('employee.barcode.edit', $barcode->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('employee.barcode.destroy', $barcode->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah anda yakin ingin menghapus ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data barcode.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @foreach($barcodes as $barcode)
        <div class="modal fade" id="modalBarcode{{ $barcode->id }}" tabindex="-1" aria-labelledby="modalBarcodeLabel{{ $barcode->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBarcodeLabel{{ $barcode->id }}">Detail Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body text-center">
                        <svg class="barcode-popup" id="barcodeSvg{{ $barcode->id }}" data-code="{{ $barcode->kode_produk }}"></svg>
                        <hr>
                        <p><strong>Kode:</strong> <span class="font-monospace">{{ $barcode->kode_produk }}</span></p>
                        <p><strong>Nama:</strong> {{ $barcode->nama_produk }}</p>
                        <p><strong>Satuan:</strong> {{ $barcode->satuan }}</p>
                        <p><strong>Kategori:</strong> {{ ucwords($barcode->kategori_produk) }}</p>
                        <p><strong>Gudang:</strong> {{ ucfirst($barcode->gudang) }}</p>
                        <button class="btn btn-outline-primary mt-3 btn-download-barcode" data-id="{{ $barcode->id }}">
                            <i class="fas fa-download"></i> Download Barcode
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Scan Kode Barcode -->
    <div class="modal fade" id="scanBarcodeModal" tabindex="-1" aria-labelledby="scanBarcodeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('employee.persediaan.scan') }}" method="GET">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scanBarcodeLabel">Scan / Input Kode Barcode</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Produk</label>
                            <input type="text" name="kode" class="form-control" placeholder="" required autofocus>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">
                            Cek
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Render barcode kecil di tabel
            document.querySelectorAll('.barcode-svg').forEach(svg => {
                JsBarcode(svg, svg.getAttribute('data-code'), {
                    format: "CODE128",
                    displayValue: true,
                    fontSize: 10,
                    width: 1.8,
                    height: 35
                });
            });

            // Render barcode besar di modal popup
            document.querySelectorAll('.barcode-popup').forEach(svg => {
                JsBarcode(svg, svg.getAttribute('data-code'), {
                    format: "CODE128",
                    displayValue: true,
                    fontSize: 16,
                    width: 2,
                    height: 70
                });
            });

            document.querySelectorAll('.btn-download-barcode').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const svg = document.getElementById('barcodeSvg' + id);

                    // Konversi SVG ke canvas
                    const svgData = new XMLSerializer().serializeToString(svg);
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    const img = new Image();

                    const svgBlob = new Blob([svgData], {type: 'image/svg+xml;charset=utf-8'});
                    const url = URL.createObjectURL(svgBlob);

                    img.onload = function () {
                        canvas.width = img.width;
                        canvas.height = img.height;
                        ctx.drawImage(img, 0, 0);
                        URL.revokeObjectURL(url);

                        // Buat link untuk download
                        const link = document.createElement('a');
                        link.download = 'barcode_' + id + '.png';
                        link.href = canvas.toDataURL('image/png');
                        link.click();
                    };
                    img.src = url;
                });
            });
        });
    </script>
    <script src="https://unpkg.com/html5-qrcode@2.3.9/minified/html5-qrcode.min.js"></script>
    <script>
        let html5QrcodeScanner;

        const showResult = (code) => {
            document.getElementById('scanned-code').textContent = code;
            document.getElementById('search-link').href = `employee.persediaan.scan?kode=${code}`;
            document.getElementById('scan-result').classList.remove('d-none');
        };

        document.getElementById('scanModal').addEventListener('shown.bs.modal', () => {
            html5QrcodeScanner = new Html5Qrcode("reader");
            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    html5QrcodeScanner.start(
                        { facingMode: "environment" },
                        { fps: 10, qrbox: 250 },
                        code => {
                            html5QrcodeScanner.stop();
                            showResult(code);
                        },
                        error => { /* Optional: handle error */ }
                    );
                }
            });
        });

        document.getElementById('scanModal').addEventListener('hidden.bs.modal', () => {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.stop().then(() => html5QrcodeScanner.clear());
            }
            document.getElementById('scan-result').classList.add('d-none');
        });
    </script>
@endpush