@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<style>
    #mapid { height: 500px; }
</style>
@endpush
@section('title')
Beranda
@endsection
@section('content')
@if (Auth::user()->toko->is_aktif == 0)
<div class="alert alert-dismissible bg-pink">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
  Akun Anda belum di verifikasi oleh admin,sehingga tidak bisa melakukan input produk.
</div>
@endif

<div class="row">
    <div class="col-md-6 col-sm-6 col-12">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Produk Saya</span>
          <span class="info-box-number">{{$tp}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-6 col-sm-6 col-12">
      <div class="info-box bg-gradient-success">
        <span class="info-box-icon"><i class="fas fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Nama Toko</span>
          <span class="info-box-number">{{$pt == null ? '-' : $pt}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
</div>


<div class="row">
  <div class="col-12">
      <div class="card">
      <div class="card-header">
          <h3 class="card-title">Data Profil</h3>
          <div class="card-tools">
          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
          <table class="table table-striped table-valign-middle">
          <thead>
              <tr>
              <th>#</th>
              <th>Parameter</th>
              <th>Keterangan</th>
              </tr>
          </thead>
          @php
              $no =1;
          @endphp
          <tbody>
          <form  method="post" action="/penjual/profil" enctype="multipart/form-data">
          @csrf
          <tr>
              <td>1</td>
              <td>Nama Usaha</td>
              <td><input type="text" class="form-control" name="nama_toko" value="{{$data->nama_toko}}"></td>
          </tr>
          <tr>
              <td>2</td>
              <td>Bidang Usaha</td>
              <td><input type="text" class="form-control" name="deskripsi" value="{{$data->deskripsi}}"></td>
          </tr>
          <tr>
              <td>3</td>
              <td>Nomor NIK</td>
              <td><input type="text" class="form-control" name="nik" value="{{$data->nik}}"></td>
          </tr>
          <tr>
              <td>4</td>
              <td>Nama Pemilik Usaha</td>
              <td><input type="text" class="form-control" name="nama_pemilik" value="{{$data->nama_pemilik}}"></td>
          </tr>
          <tr>
              <td>5</td>
              <td>Nomor NPWP</td>
              <td><input type="text" class="form-control" name="npwp" value="{{$data->npwp}}"></td>
          </tr>
          <tr>
              <td>6</td>
              <td>BANK</td>
              <td><input type="text" class="form-control" name="bank" value="{{$data->bank}}"></td>
          </tr>
          <tr>
              <td>7</td>
              <td>Nomor Rekening</td>
              <td><input type="text" class="form-control" name="norek" value="{{$data->norek}}"></td>
          </tr>
          <tr>
              <td>8</td>
              <td>Alamat Pemilik</td>
              <td><input type="text" class="form-control" name="alamat" value="{{$data->alamat}}"></td>
          </tr>
          <tr>
              <td>9</td>
              <td>Alamat Usaha</td>
              <td><input type="text" class="form-control" name="alamat_toko" value="{{$data->alamat_toko}}"></td>
          </tr>
          <tr>
              <td>10</td>
              <td>Email</td>
              <td><input type="text" class="form-control" name="email" value="{{$data->email}}"></td>
          </tr>
          <tr>
              <td>11</td>
              <td>Telp</td>
              <td><input type="text" class="form-control" name="telp" value="{{$data->telp}}"></td>
          </tr>
          <tr>
              <td>12</td>
              <td>Upload NIK (jpg/png)</td>
              <td><input type="file" class="form-control" name="file_nik">
                @if ($data->file_nik == null)
                <img class="direct-chat-img" src="/theme/dist/img/default-150x150.png" alt="message user image">
                @else
                <a href="/storage/toko_{{$data->id}}/compress/{{$data->file_nik}}" target="_blank"><img src="/storage/toko_{{$data->id}}/compress/{{$data->file_nik}}" width="20%"></a>
                    
                @endif
            </td>
          </tr>
          <tr>
              <td>13</td>
              <td>Upload NPWP (jpg/png)</td>
              <td><input type="file" class="form-control" name="file_npwp">
                @if ($data->file_npwp == null)
                <img class="direct-chat-img" src="/theme/dist/img/default-150x150.png" alt="message user image">
                @else
                <a href="/storage/toko_{{$data->id}}/compress/{{$data->file_npwp}}" target="_blank"><img src="/storage/toko_{{$data->id}}/compress/{{$data->file_npwp}}" width="20%"></a>
                @endif    
            </td>
          </tr>
          <tr>
              <td>14</td>
              <td>Peta Lokasi Usaha</td>
              <td><div id="mapid"></div>
              
            <input type="hidden" class="form-control" name="lat" id="lat" value="{{$data->lat}}" required readonly>
          
            <input type="hidden" class="form-control" name="long" id="long" value="{{$data->long}}" required readonly>
          </td>
          </tr>
          
          <tr>
              <td></td>
              <td></td>
              <td><button type="submit" class="btn btn-success btn-md btn-block"><i class="fas fa-save"></i> UPDATE</button></td>
          </tr>
          </form>

          </tbody>
          </table>
      </div>
      <!-- /.card-body -->
      </div>
  </div>
</div>

@endsection

@push('js')

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>
<script>
  
    var map = L.map('mapid').setView([-3.320363756863717, 114.6000705394259], 14);
    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                maxZoom: 16,
                subdomains:['mt0','mt1','mt2','mt3']
            }).addTo(map);
    

   
    lat = {!!$data->lat!!}
    long = {!!$data->long!!}
    L.marker([lat, long]).addTo(map);

    var theMarker = {};

    map.on('click', function(e) {
        document.getElementById("lat").value = e.latlng.lat;
        document.getElementById("long").value = e.latlng.lng;
    
        if (theMarker != undefined) {
              map.removeLayer(theMarker);
        };
        
        theMarker = L.marker([e.latlng.lat,e.latlng.lng]).addTo(map);  

        //L.marker([e.latlng.lat, e.latlng.lng]).addTo(map).on('mouseover', onClick);
    });
       // L.marker(e.latlng.lat, e.latlng.lng).addTo(map).on('mouseover', onClick);
</script>
@endpush