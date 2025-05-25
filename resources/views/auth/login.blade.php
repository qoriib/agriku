<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - kopMAKO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .brand-title {
            font-weight: 600;
            font-size: 1.6rem;
        }

        .card {
            border-radius: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="text-center mb-4">
                    <div class="brand-title">kopMAKO - Sistem Rantai Pasok</div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="mb-4 text-center">Silakan Login</h5>

                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="you@kopMAKO.com" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="********" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Masuk</button>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4 text-muted small">
                    &copy; {{ date('Y') }} kopMAKO. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</body>
</html>