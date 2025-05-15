<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dokumen Cetak')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
        }

        h1, h2, h3, h4, h5 {
            margin-bottom: 0.5rem;
        }

        .table th,
        .table td {
            vertical-align: middle !important;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                margin: 0;
            }

            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container mt-4">
        @yield('content')
    </div>
    <div class="no-print w-100 hstack gap-2 p-4 justify-content-center">
        <button class="btn btn-primary" onclick="window.print()">Cetak Ulang</button>
        <button class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
    </div>
</body>
</html>