<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Image;
use Storage;

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

    public function diterima($id)
    {
        $data = Penjualan::find($id)->update(['status' => 1]);
        toastr()->success('Pesanan Diterima');
        return back();
    }

    public function uploadnota(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'file'  => 'mimes:jpg,png,jpeg,bmp|max:1024',
        ]);

        if ($validator->fails()) {
            $req->flash();
            toastr()->error('File harus Gambar dan Maks 1MB');
            return back();
        }

        if ($req->file == null) {
            $filename = Penjualan::find($req->penjualan_id)->file;
        } else {

            $extension = $req->file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;

            $image = $req->file('file');

            $realPath = public_path('storage') . '/nota/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $filename);

            Storage::disk('public')->move($filename, '/nota/compress/' . $filename);
            $image->move($realPath, $filename);
        }

        Penjualan::find($req->penjualan_id)->update([
            'upload' => $filename
        ]);

        toastr()->success('Berhasil Di Upload');
        return back();
    }
}
