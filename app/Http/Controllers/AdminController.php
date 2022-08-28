<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $data = User::where('admin_layanan', 1)->paginate(10);
        return view('superadmin.admin.index',compact('data'));
    }
    
    public function create()
    {
        $role = Role::where('name','!=','superadmin')->where('name','!=','admin')->where('name','!=','pegawai')->get();
        return view('superadmin.admin.create',compact('role'));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' =>  'unique:users',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('User sudah ada');
            return back();
        }

        $role = Role::where('id', $request->role_id)->first();
        
        $u           = new User;
        $u->name     = $request->nama;
        $u->username = $request->username;
        $u->password = bcrypt($request->password);
        $u->admin_layanan = 1;
        $u->save();
        
        $u->roles()->attach($role);

        toastr()->success('Sukses Di Simpan');
        return redirect('/superadmin/admin');
    }

    public function edit($id)
    {
        $data = User::find($id);
        $role = Role::where('name','!=','superadmin')->where('name','!=','admin')->where('name','!=','pegawai')->get();
        
        return view('superadmin.admin.edit',compact('data','role'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' =>  'unique:users,username,'.$id,
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('Kategori sudah ada');
            return back();
        }

        $role = Role::where('id', $request->role_id)->first();
        
        $u           = User::find($id);
        $u->name     = $request->nama;
        $u->username = $request->username;
        if($request->password != null){
            $u->password = bcrypt($request->password);
        }
        $u->save();
        
        $u->roles()->sync($role);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/admin');
    }
}
