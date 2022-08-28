<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TokoController extends Controller
{
    
    public function index()
    {
        $data = Toko::paginate(10);
        return view('superadmin.toko.index',compact('data'));
    }
    
    public function create()
    {
        return view('superadmin.toko.create');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto'  => 'mimes:jpg,png,jpeg,bmp|max:5120',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('File harus Gambar dan Maks 5MB');
            return back();
        }

        if($request->foto == null){
            $filename = null;
        }else{
            $extension = $request->foto->getClientOriginalExtension();  
            $filename = uniqid().'.'.$extension;
            $request->foto->storeAs('/public/',$filename);
        }

        $attr = $request->all();
        $attr['foto'] = $filename;
        $attr['lat'] = '-3.320363756863717';
        $attr['long'] = '114.6000705394259';

        Toko::create($attr);
        
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
        
        return view('superadmin.toko.edit',compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'foto'  => 'mimes:jpg,png,jpeg,bmp|max:5120',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('File harus Gambar dan Maks 5MB');
            return back();
        }

        if($request->foto == null){
            $filename = Toko::find($id)->foto;
        }else{
            $extension = $request->foto->getClientOriginalExtension(); 
            $filename = uniqid().'.'.$extension;
            $request->foto->storeAs('/public/',$filename);
        }

        $attr = $request->all();
        $attr['foto'] = $filename;

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
        $role = Role::where('name', 'user')->first();
        //Create User Peserta
        $toko = Toko::find($id);
        $n = new User;
        $n->name = $toko->nama_toko;
        $n->username = 'pu'.$toko->id;
        $n->password = bcrypt('pengusaha');
        $n->save();

        $n->roles()->attach($role);

        $toko->update(['user_id' => $n->id]);

        toastr()->success('Akun sukses di buat, Password : pengusaha');
        return back();
    }

    public function reset($id)
    {
        $u = Toko::find($id)->user;
        $u->update([
            'password' => bcrypt('pengusaha')
        ]);

        toastr()->success('Password direset : pengusaha');
        return back();
    }
}
