<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;
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
        $check = Keranjang::where('pembeli_id', $pembeli_id)->first();
        if ($check == null) {
            $k = new Keranjang;
            $k->produk_id = $id;
            $k->pembeli_id = $pembeli_id;
            $k->jumlah = 1;
            $k->save();
            toastr()->success('Produk Sudah Ditambah');
            return redirect('/pembeli/keranjangsaya');
        } else {
            $toko = Produk::find($id)->toko;
            if ($toko->id != $check->produk->toko->id) {
                toastr()->error('Gagal Di Tambah, produk ini di toko ' . $toko->nama_toko . ' anda hanya bisa beli di 1 toko yang sama untuk 1 keranjang');
                return redirect('/pembeli/keranjangsaya');
            } else {
                $checkProduk = Keranjang::where('pembeli_id', $pembeli_id)->where('produk_id', $id)->first();

                if ($checkProduk == null) {
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

    public function delete($id)
    {
        $data = keranjang::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }

    public function checkout()
    {
        $pembeli_id = Auth::user()->pembeli->id;
        $data = Keranjang::where('pembeli_id', $pembeli_id)->orderBy('created_at', 'DESC')->get()->map(function ($item) {
            $item->harga = $item->produk->harga;
            $item->total = $item->produk->harga * $item->jumlah;
            return $item;
        });

        DB::beginTransaction();
        try {

            //simpan penjualan
            $pj['tanggal'] = Carbon::now();
            $pj['pembeli_id'] = $pembeli_id;
            $pj['toko_id'] = $data->first()->produk->toko->id;
            $penjualan = Penjualan::create($pj);

            //simpan detail penjualan
            foreach ($data as $item) {
                $dp = new DetailPenjualan;
                $dp->penjualan_id = $penjualan->id;
                $dp->produk_id = $item->produk->id;
                $dp->nama_barang = $item->produk->nama;
                $dp->deskripsi = $item->produk->deskripsi;
                $dp->harga = $item->produk->harga;
                $dp->jumlah = $item->jumlah;
                $dp->total = $item->total;
                $dp->save();
            }

            //hapus keranjang belanja
            $keranjang = Keranjang::where('pembeli_id', $pembeli_id)->get();
            foreach ($keranjang as $del) {
                $del->delete();
            }
            DB::commit();

            toastr()->success('Sukses Di Simpan');
            return redirect('/pembeli/riwayatbelanja');
        } catch (\Exception $e) {

            DB::rollback();
            toastr()->error('gagal Sistem');
            return back();
        }
    }
}
