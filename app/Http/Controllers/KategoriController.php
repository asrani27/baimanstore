<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Storage;

class KategoriController extends Controller
{

    public function index()
    {
        $data = Kategori::paginate(10);
        return view('superadmin.kategori.index', compact('data'));
    }

    public function create()
    {
        return view('superadmin.kategori.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' =>  'unique:kategori',
            'foto'  => 'mimes:png|max:1024',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('Kategori sudah ada / icon kategori Wajib PNG dan Maks 1MB');
            return back();
        }

        if ($request->foto == null) {
            $filename = null;
        } else {
            $extension = $request->foto->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;

            $image = $request->file('foto');

            $realPath = public_path('storage') . '/kategori/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $filename);

            Storage::disk('public')->move($filename, '/kategori/compress/' . $filename);
            $image->move($realPath, $filename);
        }

        $attr = $request->all();
        $attr['foto'] = $filename;
        Kategori::create($attr);

        toastr()->success('Sukses Di Simpan');
        return redirect('/superadmin/kategori');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Kategori::find($id);

        return view('superadmin.kategori.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' =>  'unique:kategori,nama,' . $id,
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('Kategori sudah ada');
            return back();
        }
        if ($request->foto == null) {
            $filename = Kategori::find($id)->foto;
        } else {
            $extension = $request->foto->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;

            $image = $request->file('foto');

            $realPath = public_path('storage') . '/kategori/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $filename);

            Storage::disk('public')->move($filename, '/kategori/compress/' . $filename);
            $image->move($realPath, $filename);
        }

        $attr = $request->all();
        $attr['foto'] = $filename;

        Kategori::find($id)->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/kategori');
    }

    public function destroy($id)
    {
        Kategori::find($id)->delete();
        toastr()->success('Sukses Di Hapus');
        return back();
    }
}
