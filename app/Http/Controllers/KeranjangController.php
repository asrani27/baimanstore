<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $pembeli_id = Auth::user()->pembeli->id;
        $data = Keranjang::where('pembeli_id', $pembeli_id)->orderBy('created_at', 'DESC');
        return view('pembeli.keranjang.index', compact('data'));
    }
}
