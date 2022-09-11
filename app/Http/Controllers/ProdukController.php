<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::orderBy('id', 'DESC')->paginate(10);
        return view('superadmin.produk.index', compact('data'));
    }

    public function create()
    {
        $kategori = Kategori::get();
        $toko = Toko::get();
        return view('superadmin.produk.create', compact('kategori', 'toko'));
    }

    public function store(Request $request)
    {
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

            $realPath = public_path('storage') . '/toko_' . $request->toko_id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $filename);

            Storage::disk('public')->move($filename, '/toko_' . $request->toko_id . '/compress/' . $filename);
            $image->move($realPath, $filename);
        }


        $attr = $request->all();
        $attr['foto'] = $filename;
        //dd($attr);
        Produk::create($attr);

        toastr()->success('Sukses Di Simpan');
        return redirect('/superadmin/produk');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Produk::find($id);

        $kategori = Kategori::get();
        $toko = Toko::get();
        return view('superadmin.produk.edit', compact('data', 'kategori', 'toko'));
    }

    public function update(Request $request, $id)
    {
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

            $realPath = public_path('storage') . '/toko_' . $request->toko_id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $filename);

            Storage::disk('public')->move($filename, '/toko_' . $request->toko_id . '/compress/' . $filename);
            $image->move($realPath, $filename);
        }

        $attr = $request->all();
        $attr['foto'] = $filename;

        Produk::find($id)->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/produk');
    }

    public function destroy($id)
    {
        Produk::find($id)->delete();
        toastr()->success('Sukses Di Hapus');
        return back();
    }
}
