<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index()
    {
        $data = Banner::get();
        return view('superadmin.banner.index',compact('data'));
    }

    public function edit($id)
    {
        $data = Banner::find($id);
        return view('superadmin.banner.edit',compact('data'));
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

        if($request->foto == null){
            $filename = Banner::find($id)->foto;
        }else{
            $extension = $request->foto->getClientOriginalExtension(); 
            $filename = uniqid().'.'.$extension;
            $request->foto->storeAs('/public/banner/',$filename);
        }

        $attr['foto'] = $filename;

        Banner::find($id)->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/banner');
    }
}
