<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    public function index()
    {

        $data = Penjualan::where('toko_id', Auth::user()->toko->id)->orderBy('status', 'ASC')->paginate(10);
        //dd($data);

        return view('penjual.pesanan.index', compact('data'));
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
            'nota' => $filename
        ]);

        toastr()->success('Berhasil Di Upload');
        return back();
    }
}
