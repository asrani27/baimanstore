<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Image;
use Storage;


class ProdukSayaController extends Controller
{

    public function index()
    {
        if (Auth::user()->toko->is_aktif == 0) {
            toastr()->error('Akun Anda Belum Aktif');
            return back();
        }

        $toko_id = Auth::user()->toko->id;
        $data = Produk::where('toko_id', $toko_id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('penjual.produk.index', compact('data'));
    }

    public function create()
    {
        if (Auth::user()->toko->is_aktif == 0) {
            toastr()->error('Akun Anda Belum Aktif');
            return back();
        }
        $kategori = Kategori::get();
        return view('penjual.produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $toko_id = Auth::user()->toko->id;

        $validator = Validator::make($request->all(), [
            'foto'  => 'mimes:jpg,png,jpeg,bmp|max:10240',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('File harus Gambar dan Maks 10MB');
            return back();
        }

        if ($request->foto == null) {
            $filename = null;
        } else {
            $extension = $request->foto->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;

            $image = $request->file('foto');

            $realPath = public_path('storage') . '/toko_' . $toko_id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $filename);

            Storage::disk('public')->move($filename, '/toko_' . $toko_id . '/compress/' . $filename);
            $image->move($realPath, $filename);
        }



        $attr = $request->all();
        $attr['foto'] = $filename;
        $attr['toko_id'] = $toko_id;

        Produk::create($attr);

        toastr()->success('Sukses Di Simpan');
        return redirect('/user/produksaya');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (Auth::user()->toko->is_aktif == 0) {
            toastr()->error('Akun Anda Belum Aktif');
            return back();
        }

        $data = Produk::find($id);

        $kategori = Kategori::get();
        return view('penjual.produk.edit', compact('data', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $toko_id = Auth::user()->toko->id;
        $validator = Validator::make($request->all(), [
            'foto'  => 'mimes:jpg,png,jpeg,bmp|max:10240',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('File harus Gambar dan Maks 10MB');
            return back();
        }

        if ($request->foto == null) {
            $filename = Produk::find($id)->foto;
        } else {

            $extension = $request->foto->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;

            $image = $request->file('foto');

            $realPath = public_path('storage') . '/toko_' . $toko_id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $filename);

            Storage::disk('public')->move($filename, '/toko_' . $toko_id . '/compress/' . $filename);
            $image->move($realPath, $filename);
        }

        $attr = $request->all();
        $attr['foto'] = $filename;
        $attr['toko_id'] = $toko_id;

        Produk::find($id)->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/user/produksaya');
    }

    public function destroy($id)
    {
        Produk::find($id)->delete();
        toastr()->success('Sukses Di Hapus');
        return back();
    }
}
