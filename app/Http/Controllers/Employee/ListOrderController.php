<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\PesananMako;

class ListOrderController extends Controller
{
    public function index()
    {
        $orders = PesananMako::with([
            'formulirPemesananMako',
            'konsumen.user',
        ])->latest()->get();

        return view('employee.order.index', compact('orders'));
    }

    public function print()
    {
        $orders = PesananMako::with(['konsumen.user', 'formulirPemesananMako', 'pengirimanMako'])->get();
        return view('employee.order.print', compact('orders'));
    }
}
