<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GantiPassController extends Controller
{
    public function gantipassuser()
    {
        return view('user.gantipass.index');
    }

    public function resetpass(Request $req)
    {
        if($req->password1 == $req->password2){
            $u = Auth::user();
            $u->password = bcrypt($req->password1);
            $u->save();
    
            Auth::logout();
            toastr()->success('Berhasil Di Ubah, Login Dengan Password Baru');
            return redirect('/');
        }else{
            toastr()->error('Password Tidak Sama');
            return back();
        }
    }

    public function profil(Request $req)
    {
        $u = Auth::user()->toko;
        $u->update($req->all());
        toastr()->success('Berhasil Di Ubah');
        return back();
    }
}
