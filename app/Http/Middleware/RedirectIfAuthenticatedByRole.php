<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedByRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            return match ($role) {
                'admin' => redirect()->route('admin.karyawan.index'),
                'karyawan' => redirect('/dashboard/karyawan'), // misal
                'pemasok' => redirect('/dashboard/pemasok'),
                'konsumen' => redirect('/dashboard/konsumen'),
                default => redirect('/'),
            };
        }
        return $next($request);
    }
}
