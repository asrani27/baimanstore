<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Image;
use Storage;

class GantiPassController extends Controller
{
    public function gantipassuser()
    {
        return view('penjual.gantipass.index');
    }

    public function resetpass(Request $req)
    {
        if ($req->password1 == $req->password2) {
            $u = Auth::user();
            $u->password = bcrypt($req->password1);
            $u->save();

            Auth::logout();
            toastr()->success('Berhasil Di Ubah, Login Dengan Password Baru');
            return redirect('/');
        } else {
            toastr()->error('Password Tidak Sama');
            return back();
        }
    }

    public function profil(Request $req)
    {

        $toko_id = Auth::user()->toko->id;

        $validator = Validator::make($req->all(), [
            'file_nik'  => 'mimes:jpg,png,jpeg,bmp|max:10240',
            'file_npwp'  => 'mimes:jpg,png,jpeg,bmp|max:10240',
        ]);

        if ($validator->fails()) {
            $req->flash();
            toastr()->error('File harus Gambar dan Maks 10MB');
            return back();
        }

        if ($req->file_nik == null) {
            $file_nik = Auth::user()->toko->file_nik;
        } else {
            $extension = $req->file_nik->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;

            $image = $req->file('file_nik');

            $realPath = public_path('storage') . '/toko_' . $toko_id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $filename);

            Storage::disk('public')->move($filename, '/toko_' . $toko_id . '/compress/' . $filename);
            $image->move($realPath, $filename);
            $file_nik = $filename;
        }

        if ($req->file_npwp == null) {
            $file_npwp = Auth::user()->toko->file_npwp;
        } else {
            $extension = $req->file_npwp->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;

            $image = $req->file('file_npwp');

            $realPath = public_path('storage') . '/toko_' . $toko_id . '/real';
            $compressPath = public_path('storage');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($compressPath . '/' . $filename);

            Storage::disk('public')->move($filename, '/toko_' . $toko_id . '/compress/' . $filename);
            $image->move($realPath, $filename);
            $file_npwp = $filename;
        }


        $attr = $req->all();
        $attr['file_nik'] = $file_nik;
        $attr['file_npwp'] = $file_npwp;

        $u = Auth::user()->toko;
        $u->update($attr);
        toastr()->success('Berhasil Di Ubah');
        return back();
    }
}
