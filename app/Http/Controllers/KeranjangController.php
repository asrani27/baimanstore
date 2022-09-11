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
        $data = Keranjang::where('pembeli_id', $pembeli_id)->orderBy('created_at', 'DESC')->get()->map(function ($item) {
            $item->harga = $item->produk->harga;
            $item->total = $item->produk->harga * $item->jumlah;
            return $item;
        });

        return view('pembeli.keranjang.index', compact('data'));
    }

    public function addToCart($id)
    {
        $pembeli_id = Auth::user()->pembeli->id;
        $check = Keranjang::where('pembeli_id', $pembeli_id)->where('produk_id', $id)->first();

        if ($check == null) {
            $k = new Keranjang;
            $k->produk_id = $id;
            $k->pembeli_id = $pembeli_id;
            $k->jumlah = 1;
            $k->save();
            toastr()->success('Produk Sudah Ditambah');
            return redirect('/pembeli/keranjangsaya');
        } else {
            toastr()->error('Produk Sudah Ada');
            return redirect('/pembeli/keranjangsaya');
        }
    }

    public function update(Request $req)
    {
        $data = keranjang::find($req->keranjang_id)->update([
            'jumlah' => $req->jumlah
        ]);
        toastr()->success('Jumlah Berhasil Di Update');
        return redirect('/pembeli/keranjangsaya');
    }
}
