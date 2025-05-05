<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="ms-auto">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-light border-end vh-100 p-3">
                <h6 class="text-uppercase fw-bold">Menu</h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="{{ route('admin.karyawan.index') }}" class="nav-link {{ request()->routeIs('admin.karyawan.*') ? 'active' : '' }}">Karyawan</a></li>
                    <li class="nav-item"><a href="{{ route('admin.pemasok.index') }}" class="nav-link {{ request()->routeIs('admin.pemasok.*') ? 'active' : '' }}">Pemasok</a></li>
                    <li class="nav-item"><a href="{{ route('admin.konsumen.index') }}" class="nav-link {{ request()->routeIs('admin.konsumen.*') ? 'active' : '' }}">Konsumen</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>
