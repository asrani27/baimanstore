<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Storage;

class TokoController extends Controller
{

    public function index()
    {
        $data = Toko::orderBy('id', 'DESC')->paginate(10);
        return view('superadmin.toko.index', compact('data'));
    }

    public function create()
    {
        return view('superadmin.toko.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'foto'  => 'mimes:jpg,png,jpeg,bmp|max:5024',
            'file_nik'  => 'mimes:jpg,png,jpeg,bmp|max:5024',
            'file_npwp'  => 'mimes:jpg,png,jpeg,bmp|max:5024',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('File harus Gambar dan Maks 5MB');
            return back();
        }

        $attr = $request->all();
        $attr['lat'] = '-3.320363756863717';
        $attr['long'] = '114.6000705394259';

        $toko = Toko::create($attr);

        if ($request->foto == null) {
            $filename = null;
        } else {
            $extension = $request->foto->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;

            $image = $request->file('foto');

            $realPath = public_path('storage') . '/toko_' . $toko->id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $filename);

            Storage::disk('public')->move($filename, '/toko_' . $toko->id . '/compress/' . $filename);
            $image->move($realPath, $filename);
        }

        if ($request->file_nik == null) {
            $file_nik = null;
        } else {
            $extension = $request->file_nik->getClientOriginalExtension();
            $file_nik = uniqid() . '.' . $extension;

            $image = $request->file('file_nik');

            $realPath = public_path('storage') . '/toko_' . $toko->id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $file_nik);

            Storage::disk('public')->move($file_nik, '/toko_' . $toko->id . '/compress/' . $file_nik);
            $image->move($realPath, $file_nik);
        }
        if ($request->file_npwp == null) {
            $file_npwp = null;
        } else {
            $extension = $request->file_npwp->getClientOriginalExtension();
            $file_npwp = uniqid() . '.' . $extension;

            $image = $request->file('file_npwp');

            $realPath = public_path('storage') . '/toko_' . $toko->id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $file_npwp);

            Storage::disk('public')->move($file_npwp, '/toko_' . $toko->id . '/compress/' . $file_npwp);
            $image->move($realPath, $file_npwp);
        }
        $toko->update([
            'foto' => $filename,
            'file_nik' => $file_nik,
            'file_npwp' => $file_npwp,
        ]);

        toastr()->success('Sukses Di Simpan');
        return redirect('/superadmin/toko');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Toko::find($id);

        return view('superadmin.toko.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'foto'  => 'mimes:jpg,png,jpeg,bmp|max:5024',
            'file_nik'  => 'mimes:jpg,png,jpeg,bmp|max:5024',
            'file_npwp'  => 'mimes:jpg,png,jpeg,bmp|max:5024',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('File harus Gambar dan Maks 5MB');
            return back();
        }

        if ($request->foto == null) {
            $filename = Toko::find($id)->foto;
        } else {
            $extension = $request->foto->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;

            $image = $request->file('foto');

            $realPath = public_path('storage') . '/toko_' . $id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $filename);

            Storage::disk('public')->move($filename, '/toko_' . $id . '/compress/' . $filename);
            $image->move($realPath, $filename);
        }

        if ($request->file_nik == null) {
            $file_nik = Toko::find($id)->file_nik;
        } else {
            $extension = $request->file_nik->getClientOriginalExtension();
            $file_nik = uniqid() . '.' . $extension;

            $image = $request->file('file_nik');

            $realPath = public_path('storage') . '/toko_' . $id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $file_nik);

            Storage::disk('public')->move($file_nik, '/toko_' . $id . '/compress/' . $file_nik);
            $image->move($realPath, $file_nik);
        }

        if ($request->file_npwp == null) {
            $file_npwp = Toko::find($id)->file_npwp;
        } else {
            $extension = $request->file_npwp->getClientOriginalExtension();
            $file_npwp = uniqid() . '.' . $extension;

            $image = $request->file('file_npwp');

            $realPath = public_path('storage') . '/toko_' . $id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $file_npwp);

            Storage::disk('public')->move($file_npwp, '/toko_' . $id . '/compress/' . $file_npwp);
            $image->move($realPath, $file_npwp);
        }

        $attr = $request->all();
        $attr['foto'] = $filename;
        $attr['file_nik'] = $file_nik;
        $attr['file_npwp'] = $file_npwp;

        Toko::find($id)->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/toko');
    }

    public function destroy($id)
    {
        Toko::find($id)->delete();
        toastr()->success('Sukses Di Hapus');
        return back();
    }

    public function akun($id)
    {
        $role = Role::where('name', 'penjual')->first();
        //Create User Peserta
        $toko = Toko::find($id);
        $n = new User;
        $n->name = $toko->nama_toko;
        $n->username = 'umkm' . $toko->id;
        $n->password = bcrypt('penjual');
        $n->save();

        $n->roles()->attach($role);

        $toko->update(['user_id' => $n->id]);

        toastr()->success('Akun sukses di buat, Password : penjual');
        return back();
    }

    public function reset($id)
    {
        $u = Toko::find($id)->user;
        $u->update([
            'password' => bcrypt('penjual')
        ]);

        toastr()->success('Password direset : penjual');
        return back();
    }
}
