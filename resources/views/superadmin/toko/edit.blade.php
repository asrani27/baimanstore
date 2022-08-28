@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    EDIT
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <a href="/superadmin/toko" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a><br/><br/>
<form method="post" action="/superadmin/toko/{{$data->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-body">                   

                      
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Toko</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_toko" value="{{$data->nama_toko}}" required>
                    </div>
                    </div>

                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat Toko</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="alamat_toko" value="{{$data->alamat_toko}}" required>
                    </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pemilik</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_pemilik" value="{{$data->nama_pemilik}}" required>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat Pemilik</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="alamat" value="{{$data->alamat}}" required>
                    </div>
                    </div>

                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telp</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="telp" value="{{$data->telp}}" required>
                    </div>
                    </div>
                    
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="{{$data->email}}" required>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Deskripsi Toko</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi" class="form-control">{{$data->deskripsi}}</textarea>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto">
                    </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-block btn-primary"><strong>UPDATE</strong></button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    </div>
</div>

@endsection

@push('js')

@endpush