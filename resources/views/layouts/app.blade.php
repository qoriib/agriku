<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Rantai Pasok')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>
<body>

    <div class="sidebar border-end">
        <h4 class="text-center py-4">Agriku</h4>
        <div class="vstack gap-3 px-4">
            @auth
                @php $role = Auth::user()->role; @endphp

                @if($role === 'kepala_divisi')
                    <a class="btn btn-light" href="{{ route('divisi.pesanan.index') }}">Pesanan Mako</a>
                    <a class="btn btn-light" href="{{ route('divisi.pembayaran.index') }}">Pembayaran Mako</a>
                @elseif(in_array($role, ['admin', 'staf_pengadaan', 'staf_produksi', 'staf_logistik']))
                    <a class="btn btn-light" href="{{ route('employee.barcode.index') }}">Barcode</a>
                    <a class="btn btn-light" href="{{ route('employee.persediaan.stok') }}">Daftar Persediaan</a>
                    <a class="btn btn-light" href="{{ route('employee.persediaan.riwayat') }}">Riwayat Persediaan</a>
                    <a class="btn btn-light" href="{{ route('employee.pengiriman.index') }}">Pengiriman Mako</a>
                @elseif($role === 'konsumen')
                    <a class="btn btn-light" href="{{ route('customer.mako.index') }}">Pesanan Mako</a>
                    <a class="btn btn-light" href="{{ route('customer.pembayaran.index') }}">Pembayaran Mako</a>
                @elseif($role === 'pemasok')
                    <span class="text-muted small">Menu untuk pemasok belum ditambahkan</span>
                @else
                    <span class="text-muted small">Peran tidak dikenali</span>
                @endif
            @endauth
        </div>
    </div>

    <div class="content">
        <div class="topbar border-bottom">
            <div class="container d-flex justify-content-end px-4 py-3">
                <div class="hstack align-items-center gap-3">
                    @auth
                        <span>{{ Auth::user()->name }}</span>
                        {!! Auth::user()->getRoleBadge() !!}
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
        <div class="container gap-5 p-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>