<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function pegawai()
    {
        return Auth::user()->pegawai;
    }

    public function layanan($id)
    {
        $detailLayanan = Layanan::find($id);
        $layanan = Layanan::get();
        $pegawai = $this->pegawai();
        return view('pegawai.layanan.index',compact('layanan','detailLayanan','pegawai'));
    }

    public function store(Request $req, $id)
    {
        $check = Pengajuan::where('layanan_id', $id)->where('pegawai_id',$this->pegawai()->id)->where('status',0)->first();
        if($check == null){
            $p = new Pengajuan;
            $p->layanan_id = $id;
            $p->pegawai_id = $this->pegawai()->id;
            $p->persyaratan_id = json_encode($req->syarat);
            $p->save();
    
            toastr()->success('Berhasil Di Ajukan');
            return redirect('/pegawai/home');
        }else{
            toastr()->error('Anda sudah mengajukan layanan ini dan masih tahap proses');
            return back();
        }
    }

    public function delete($id)
    {
        Pengajuan::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }
}
