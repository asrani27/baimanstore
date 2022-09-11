<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\GantiPassController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProdukSayaController;
use App\Http\Controllers\PersyaratanController;

Route::get('/', [HomeController::class, 'welcome']);
Route::get('/tentangkami', [HomeController::class, 'tentang']);
Route::get('/kontak', [HomeController::class, 'kontak']);
Route::get('/pengrajin', [HomeController::class, 'pengrajin']);
Route::get('/pengrajin/produk/{id}', [HomeController::class, 'produkPengrajin']);
Route::get('/semuaproduk', [HomeController::class, 'semuaproduk']);
Route::get('/kategori/{id}/detail', [HomeController::class, 'kategoriproduk']);
Route::get('/produk/cari', [HomeController::class, 'cariProduk']);
Route::get('/produk/{id}/detail', [HomeController::class, 'detailProduk']);
Route::get('/daftar', [HomeController::class, 'daftar']);
Route::post('/daftar/pembeli', [HomeController::class, 'daftarPembeli']);
Route::post('/daftar/penjual', [HomeController::class, 'daftarPenjual']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/login', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('superadmin')) {
            return redirect('/superadmin/home');
        } elseif (Auth::user()->hasRole('pembeli')) {
            return redirect('/pembeli/home');
        } elseif (Auth::user()->hasRole('penjual')) {
            return redirect('/penjual/home');
        }
    }
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::get('/daftar', [LoginController::class, 'daftar']);
Route::post('/daftar', [LoginController::class, 'simpanDaftar']);

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::prefix('superadmin')->group(function () {
        Route::get('gantipass', [HomeController::class, 'gantipass']);
        Route::post('gantipass', [HomeController::class, 'resetpass']);

        Route::get('/toko/{id}/akun', [TokoController::class, 'akun']);
        Route::get('/toko/{id}/reset', [TokoController::class, 'reset']);

        Route::resource('profildinas', ProfilController::class);
        Route::resource('banner', BannerController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('toko', TokoController::class);
        Route::resource('produk', ProdukController::class);
    });
});

Route::group(['middleware' => ['auth', 'role:pembeli']], function () {
    Route::prefix('pembeli')->group(function () {
        Route::get('gantipass', [GantiPassController::class, 'gantipassuser']);
        Route::post('gantipass', [GantiPassController::class, 'resetpass']);
        Route::post('profil', [GantiPassController::class, 'profil']);
        Route::get('keranjangsaya', [KeranjangController::class, 'index']);
        Route::get('keranjangsaya/{id}/delete', [KeranjangController::class, 'delete']);
        Route::get('masukkankeranjang/{id}', [KeranjangController::class, 'addToCart']);
        Route::post('keranjangsaya/update', [KeranjangController::class, 'update']);
    });
});

Route::group(['middleware' => ['auth', 'role:penjual']], function () {
    Route::prefix('penjual')->group(function () {
        Route::get('gantipass', [GantiPassController::class, 'gantipassuser']);
        Route::post('gantipass', [GantiPassController::class, 'resetpass']);
        Route::post('profil', [GantiPassController::class, 'profil']);
        Route::resource('produksaya', ProdukSayaController::class);
    });
});

Route::group(['middleware' => ['auth', 'role:superadmin|user|penjual|pembeli']], function () {
    Route::get('/superadmin/home', [HomeController::class, 'superadmin']);
    Route::get('/user/home', [HomeController::class, 'user']);
    Route::get('/penjual/home', [HomeController::class, 'penjual']);
    Route::get('/pembeli/home', [HomeController::class, 'pembeli']);
});
