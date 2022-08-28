<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Skpd;
use App\Models\User;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    public function index()
    {
        $data = Skpd::get();
        return view('superadmin.skpd.index',compact('data'));
    }
    
    public function akun($id)
    {
        $role = Role::where('name', 'admin')->first();
        //Create User Peserta
        $skpd = Skpd::find($id);
        $n = new User;
        $n->name = $skpd->nama;
        $n->username = $skpd->kode_skpd;
        $n->password = bcrypt('adminskpd');
        $n->save();

        $n->roles()->attach($role);

        $skpd->update(['user_id' => $n->id]);

        toastr()->success('Akun sukses di buat, Password : adminskpd');
        return back();
    }
}
