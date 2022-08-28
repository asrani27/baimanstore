<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BiodataController extends Controller
{
    public function index()
    {
        $page = 'profil';
        $pegawai = Auth::user()->pegawai;
        $pathfoto = '/storage/'.$pegawai->nip.'/'.$pegawai->foto;
        
        return view('pegawai.biodata',compact('pegawai','page','pathfoto'));
    }
    
    public function pasangan()
    {
        $page = 'pasangan';
        return view('pegawai.biodata',compact('page'));
    }
    public function anak()
    {
        $page = 'anak';
        return view('pegawai.biodata',compact('page'));
    }
    public function orangtua()
    {
        $page = 'orangtua';
        return view('pegawai.biodata',compact('page'));
    }
    public function pendidikan()
    {
        $page = 'pendidikan';
        return view('pegawai.biodata',compact('page'));
    }

    public function create()
    {
        $syarat = Persyaratan::get();
        return view('superadmin.layanan.create',compact('syarat'));
    }
    
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $l = Layanan::create($request->all());
            $l->persyaratan()->attach($request->syarat);
            DB::commit();
            
            toastr()->success('Sukses Di Simpan');
            return redirect('/superadmin/layanan');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal');
            return back();
        }
        
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $data = Layanan::find($id);
        
        $syarat = Persyaratan::get();
        return view('superadmin.layanan.edit',compact('data','syarat'));
    }
    
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $l = Layanan::find($id);
            $l->nama = $request->nama;
            $l->save();
            
            $l->persyaratan()->sync($request->syarat);
            DB::commit();
    
            toastr()->success('Sukses Di Update');
            return redirect('/superadmin/layanan');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal');
            return back();
        }
    }

    public function destroy($id)
    {
        Layanan::find($id)->delete();
        toastr()->success('Sukses Di Hapus');
        return back();
    }

    public function foto(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'mimes:png,jpg,jpeg|max:10240'
        ]);

        if ($validator->fails()) {
            toastr()->error('File harus png/jpg/jpeg dan max 10MB');
            return back();
        }
        
        $p = Auth::user()->pegawai;
        $filename      = $req->file->getClientOriginalName();
        //Update file foto di pegawai
        if($p->foto == null){
            $p->foto = $filename;
            $p->save();
        }else{
            $path = '/public/'.$p->nip.'/'.$p->foto;     
            Storage::delete($path);
            $p->foto = $filename;
            $p->save();
        }
        $req->file->storeAs('/public/'.$p->nip.'/',$filename);
        return back();
    }
}
