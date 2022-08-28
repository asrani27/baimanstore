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

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::get('/login', function(){
    if(Auth::check()){
        if(Auth::user()->hasRole('superadmin')){
            return redirect('/superadmin/home');
        }else{
            return redirect('/user/home');
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

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::prefix('user')->group(function () {
        Route::get('gantipass', [GantiPassController::class, 'gantipassuser']);
        Route::post('gantipass', [GantiPassController::class, 'resetpass']);
        Route::post('profil', [GantiPassController::class, 'profil']);
        Route::resource('produksaya', ProdukSayaController::class);
    });    
});


Route::group(['middleware' => ['auth', 'role:superadmin|user']], function () {
    Route::get('/superadmin/home', [HomeController::class, 'superadmin']);
    Route::get('/user/home', [HomeController::class, 'user']);
});