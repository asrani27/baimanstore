<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function index()
    {
        $upload = Persyaratan::get()->map(function($item){
            $item->datafile = Upload::where('pegawai_id',Auth::user()->pegawai->id)->where('persyaratan_id', $item->id)->get();
            return $item;
        });
        return view('pegawai.upload.index',compact('upload'));
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'mimes:pdf,png,jpg,jpeg|max:10240'
        ]);

        if ($validator->fails()) {
            toastr()->error('File harus pdf/png/jpg/jpeg dan max 10MB');
            return back();
        }
        $ext      = $req->file->getClientOriginalExtension();
        $jenis    = Persyaratan::find($req->persyaratan_id)->nama;
        $filename = $req->nama.'-'.date('dmY-His').'-'.$jenis.'.'.$ext;    
        $nip      = Auth::user()->pegawai->nip;

        $req->file->storeAs('/public/'.$nip.'/',$filename);

        //Simpan Data
        $u = new Upload;
        $u->persyaratan_id  = $req->persyaratan_id;
        $u->pegawai_id      = Auth::user()->pegawai->id;
        $u->nama            = $req->nama;
        $u->file            = $filename;
        $u->save();

        toastr()->success('File berhasil Di Simpan');
        return back();
    }

    public function deleteFile($id)
    {
        $nip  = Auth::user()->pegawai->nip;
        $data = Upload::find($id);
        $path = '/public/'.$nip.'/'.$data->file;

        Storage::delete($path);

        $data->delete();
        
        toastr()->success('Berhasil Di Hapus');
        return back();
    }
}
