@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
  
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

  
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<style>
    #mapid { height: 500px; }
</style>
@endpush
@section('title')
    ADMIN
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Profil Dinas</h3>
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
            <form  method="post" action="/superadmin/profildinas/{{$data->id}}">
            @csrf
            @method('PUT')
            <tr>
                <td>1</td>
                <td>Nama SKPD</td>
                <td><input type="text" class="form-control" name="nama" value="{{$data->nama}}"></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Singkatan</td>
                <td><input type="text" class="form-control" name="singkatan" value="{{$data->singkatan}}"></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Alamat</td>
                <td><input type="text" class="form-control" name="alamat" value="{{$data->alamat}}"></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Telp</td>
                <td><input type="text" class="form-control" name="telp" value="{{$data->telp}}"></td>
            </tr>
            <tr>
                <td>5</td>
                <td>WA</td>
                <td><input type="text" class="form-control" name="wa" value="{{$data->wa}}"></td>
            </tr>
            <tr>
                <td>6</td>
                <td>Email</td>
                <td><input type="text" class="form-control" name="email" value="{{$data->email}}"></td>
            </tr>
            <tr>
                <td>7</td>
                <td>Facebook</td>
                <td><input type="text" class="form-control" name="facebook" value="{{$data->facebook}}"></td>
            </tr>
            <tr>
                <td>8</td>
                <td>Instagram</td>
                <td><input type="text" class="form-control" name="ig" value="{{$data->ig}}"></td>
            </tr>
            <tr>
                <td>9</td>
                <td>Jam Kerja</td>
                <td><input type="text" class="form-control" name="jam_kerja" value="{{$data->jam_kerja}}"></td>
            </tr>
            <tr>
                <td>10</td>
                <td>Tentang Kami</td>
                <td><textarea class="form-control" name="tentang_kami" id="summernote">{{$data->tentang_kami}}</textarea></td>
            </tr>
            <tr>
                <td>11</td>
                <td>Peta Map</td>
                <td><div id="mapid"></div>
                
              <input type="hidden" class="form-control" name="lat" id="lat" value="{{$data->lat}}" required readonly>
            
              <input type="hidden" class="form-control" name="long" id="long" value="{{$data->long}}" required readonly></td>
            </tr>
            
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> UPDATE</button></td>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>
<script>
    var map = L.map('mapid').setView([-3.320363756863717, 114.6000705394259], 14);
    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                maxZoom: 16,
                subdomains:['mt0','mt1','mt2','mt3']
            }).addTo(map);
    

    var banjirIcon = L.icon({
       iconUrl: '/marker/marker-icon-blue.png',
    });
    
    var lastIcon = L.icon({
       iconUrl: '/marker/marker-icon-red.png',
    });

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