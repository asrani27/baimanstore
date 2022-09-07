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
        <a href="/superadmin/kategori" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a><br/><br/>
<form method="post" action="/superadmin/kategori/{{$data->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-body">                   

                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" required value="{{$data->nama}}" >
                    </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Komoditas</label>
                        <div class="col-sm-10">
                            <select name="komoditas" class="form-control" required>
                                <option value="">-pilih-</option>
                                <option value="barang" {{$data->komoditas == 'barang' ? 'selected':''}}>Barang</option>
                                <option value="jasa" {{$data->komoditas == 'jasa' ? 'selected':''}}>Jasa</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Icon/Gambar</label>
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