<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayananController extends Controller
{
    public function index()
    {
        $data = Layanan::paginate(10);
        return view('superadmin.layanan.index',compact('data'));
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
}
