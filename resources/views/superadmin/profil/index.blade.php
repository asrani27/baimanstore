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
            <tr>
                <td>1</td>
                <td>Nama SKPD</td>
                <td>{{$data->nama}}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Singkatan</td>
                <td>{{$data->singkatan}}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Alamat</td>
                <td>{{$data->alamat}}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Telp</td>
                <td>{{$data->telp}}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>WA</td>
                <td>{{$data->wa}}</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Email</td>
                <td>{{$data->email}}</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Facebook</td>
                <td>{{$data->facebook}}</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Instagram</td>
                <td>{{$data->ig}}</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Jam Kerja</td>
                <td>{{$data->jam_kerja}}</td>
            </tr>
            <tr>
                <td>10</td>
                <td>Tentang Kami</td>
                <td>{!!$data->tentang_kami!!}</td>
            </tr>
            <tr>
                <td>11</td>
                <td>Peta Lokasi</td>
                <td><div id="mapid"></div>

                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    
                <a href="/superadmin/profildinas/{{$data->id}}/edit" class="btn btn-xs btn-success"><i class="fas fa-edit"></i> Edit Profil</a>
                </td>
                <td></td>
            </tr>
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
    

    var banjirIcon = L.icon({
       iconUrl: '/marker/marker-icon-blue.png',
    });
    
    var lastIcon = L.icon({
       iconUrl: '/marker/marker-icon-red.png',
    });

    lat = {!!$data->lat!!}
    long = {!!$data->long!!}
    
    L.marker([lat, long]).addTo(map).bindPopup('Lokasi Kantor Dinas')
    .openPopup();
</script>
@endpush