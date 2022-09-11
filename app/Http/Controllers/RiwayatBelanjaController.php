<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatBelanjaController extends Controller
{
    public function index()
    {
        $pembeli_id = Auth::user()->pembeli->id;
        $data = Penjualan::where('pembeli_id', $pembeli_id)->orderBy('id', 'DESC')->get()->map(function ($item) {
            $item->total = $item->detail->map(function ($item2) {
                $item2->total = $item2->harga * $item2->jumlah;
                return $item2;
            })->sum('total');
            return $item;
        });

        return view('pembeli.belanja.index', compact('data'));
    }

    public function detail($id)
    {
        $data = Penjualan::find($id)->detail->map(function ($item) {
            $item->total = $item->harga * $item->jumlah;
            return $item;
        });

        return view('pembeli.belanja.detail', compact('data'));
    }
}
