<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $data = Penjualan::where('toko_id', Auth::user()->toko->id)->orderBy('status', 'ASC')->paginate(10);


        return view('penjual.pesanan.index', compact('data'));
    }
}
