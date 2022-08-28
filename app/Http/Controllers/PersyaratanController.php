<?php

namespace App\Http\Controllers;

use App\Models\Persyaratan;
use Illuminate\Http\Request;

class PersyaratanController extends Controller
{
    public function index()
    {
        $data = Persyaratan::paginate(10);
        return view('superadmin.persyaratan.index',compact('data'));
    }
    
    public function create()
    {
        return view('superadmin.persyaratan.create');
    }
    
    public function store(Request $request)
    {
        Persyaratan::create($request->all());
        
        toastr()->success('Sukses Di Simpan');
        return redirect('/superadmin/persyaratan');
        
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $data = Persyaratan::find($id);
        
        return view('superadmin.persyaratan.edit',compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $check = Persyaratan::where('nama', $request->nama)->first();
        if($check == null){
            $attr = $request->all();

            Persyaratan::find($id)->update($attr);
    
            toastr()->success('Sukses Di Update');
            return redirect('/superadmin/persyaratan');
        }else{
            toastr()->error('Nama Persyaratan Sudah Ada');
            return back();
        }
    }

    public function destroy($id)
    {
        Persyaratan::find($id)->delete();
        toastr()->success('Sukses Di Hapus');
        return back();
    }
}
