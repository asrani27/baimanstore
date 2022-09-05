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
<div class="row">
    <div class="col-md-6 col-sm-6 col-12">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Keranjang Saya</span>
          <span class="info-box-number">23</span>

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
          <span class="info-box-text">Total Belanja</span>
          <span class="info-box-number">Rp., 5.000.988.888</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
</div>



@endsection

@push('js')

@endpush