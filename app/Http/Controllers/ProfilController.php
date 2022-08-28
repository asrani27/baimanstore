<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $data = Profil::first();
        return view('superadmin.profil.index',compact('data'));
    } 
    
    public function edit($id)
    {
        $data = Profil::find($id);        
        return view('superadmin.profil.edit',compact('data'));
    }
    public function update(Request $request, $id)
    {
        
        $attr = $request->all();
        
        Profil::find($id)->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/profildinas');
    }
}
