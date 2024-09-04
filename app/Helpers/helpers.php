<?php

use App\Models\Upload;
use App\Models\Keranjang;
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

function rating($rating)
{
    if ($rating == 0) {
        return '<img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png">';
    }
    if ($rating == 1) {
        return '<img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png">';
    }
    if ($rating == 0) {
        return '<img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png">';
    }
    if ($rating == 0) {
        return '<img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png">';
    }
    if ($rating == 0) {
        return '<img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png">';
    }
    if ($rating == 0) {
        return '<img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png"><img src="/star/off.png">';
    }
}

function keranjangSaya($user)
{
    return Keranjang::where('pembeli_id', $user->pembeli->id)->sum('jumlah');
}
function pesananMasuk()
{
    return Penjualan::where('toko_id', Auth::user()->toko->id)->where('status', 0)->count();
}
