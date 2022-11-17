<?php

use App\Models\Upload;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Auth;

function listUpload($pegawai_id, $persyaratan_id)
{
    return Upload::where('pegawai_id', $pegawai_id)->where('persyaratan_id', $persyaratan_id)->get();
}

function listSyarat($persyaratan_id)
{
    $id = json_decode($persyaratan_id);
    return Upload::whereIn('id', $id)->get();
}

function pesananMasuk()
{
    return Penjualan::where('toko_id', Auth::user()->toko->id)->where('status', 0)->count();
}
