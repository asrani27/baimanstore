<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Image;


class ProdukSayaController extends Controller
{
    
    public function index()
    {
        $toko_id = Auth::user()->toko->id;
        $data = Produk::where('toko_id', $toko_id)->orderBy('created_at','DESC')->paginate(10);
        return view('user.produk.index',compact('data'));
    }
    
    public function create()
    {
        $kategori = Kategori::get();
        return view('user.produk.create',compact('kategori'));
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

        if($request->foto == null){
            $filename = null;
        }else{
            $extension = $request->foto->getClientOriginalExtension(); 
            $filename = uniqid().'.'.$extension;
            
            $request->foto->storeAs('/public/'.$toko_id,$filename);

            $image = $request->file('foto');
            $input['imagename'] = time().'.'.$image->extension();
        
            $filePath = public_path('storage');
            
            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$filename);
    
            $filePath = public_path('/images');
            
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
        $data = Produk::find($id);
        
        $kategori = Kategori::get();
        return view('user.produk.edit',compact('data','kategori'));
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

        if($request->foto == null){
            $filename = Produk::find($id)->foto;
        }else{
            $extension = $request->foto->getClientOriginalExtension(); 
            $filename = uniqid().'.'.$extension;
            $request->foto->storeAs('/public/'.$request->toko_id,$filename);
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
