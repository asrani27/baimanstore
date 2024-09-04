<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IKM KAPUAS</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/theme/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/theme/dist/css/adminlte.min.css"> 
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
  <style>
      #mapid { height: 200px; }
  </style>
  @toastr_css
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark bg-gradient-primary text-white">
    <div class="container">
      <a href="/" class="navbar-brand">
        {{-- <img src="#" alt="" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        {{-- <span class="brand-text font-weight-light">IKM Industri Kecil Menengah</span> --}}
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav text-bold">
          <li class="nav-item">
            <a href="/" class="nav-link"><i class="fas fa-home"></i> Beranda</a>
          </li>
          <li class="nav-item">
            <a href="/tentangkami" class="nav-link"><i class="fas fa-university"></i> Tentang Kami</a>
          </li>
          
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-shopping-cart"></i> Produk</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="/semuaproduk" class="dropdown-item">Semua Kategori </a></li>
              @foreach ($kategori as $item)
                  
              <li><a href="/kategori/{{$item->id}}/detail" class="dropdown-item">{{$item->nama}}</a></li>
              @endforeach
            </ul>
          </li>
          <li class="nav-item">
            <a href="/kontak" class="nav-link"><i class="fas fa-phone"></i> Kontak</a>
          </li>
          

        </ul>
      </div>
      
      @if (!Auth::check()) 
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a href="/login" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login</a>
        </li>
      </ul>
      @endif
      
      @if (Auth::check())
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        
          @if (Auth::user()->hasRole('superadmin'))
          <li class="nav-item">
          <a class="nav-link" href="/superadmin/home" role="button">
            <i class="fa fa-user"></i> {{Auth::user()->name}}
          </a>
          </li>
          @elseif (Auth::user()->hasRole('user'))
          <li class="nav-item">
          <a class="nav-link" href="/user/keranjangsaya" role="button">
            <i class="fa fa-shopping-cart"></i> <strong>{{keranjangSaya(Auth::user())}} item</strong>
          </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="/user/home" role="button">
            <i class="fa fa-user"></i> {{Auth::user()->name}}
          </a>
          </li>
          @endif
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="/logout" role="button">
            <i class="fa fa-sign-out"></i>
          </a>
        </li> --}}
      </ul>
      @endif
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br/>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        @yield('content')

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  <!-- Main Footer -->
  <footer class="main-footer bg-dark">
    <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h4><i class="fas fa-map-marker-alt mr-1"></i> Alamat Kantor</h4>
        {{$profil->alamat}}
        <br/><br/>
        
        <h4><i class="fas fa-clock mr-1"></i> Jam Kerja</h4> <br/>
        {{$profil->jam_kerja}}
      </div>
      <div class="col-md-6">
        <h4><i class="fas fa-comments mr-1"></i> Informasi Kontak</h4> 
        <div class="row">
          <div class="col-md-6 text-bold">
            E-Mail <br/>
            {{$profil->email}}
          </div>
          <div class="col-md-6 text-bold">
            Facebook <br/>
            {{$profil->facebook}}
          </div>
        </div>
        <br/><br/>
        
        <h4><i class="fas fa-map mr-1"></i> Peta Lokasi</h4>
        
        <div class="row">
          <div class="col-md-12">
            <div id="mapid"></div>
          </div>
          {{-- <div class="col-md-4 text-bold">
            Hari Ini
          </div>
          <div class="col-md-4 text-bold">
            Bulan Ini
          </div>
          <div class="col-md-4 text-bold">
            Total
          </div> --}}
        </div>
      </div>
    </div>
    <br/>
    <br/>
    <div class="row text-center">
      <div class="col-md-12">
        <h3>PEMERINTAH KABUPATEN KAPUAS</h3> 
      </div>
    </div>
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/theme/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/theme/dist/js/demo.js"></script>
@toastr_js
@toastr_render

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>
<script>
  lat = {!!$profil->lat!!}
  long = {!!$profil->long!!}

    var map = L.map('mapid').setView([lat, long], 14);
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

    
    L.marker([lat, long]).addTo(map).bindPopup('Lokasi Kantor Dinas')
    .openPopup();
</script>
</body>
</html>
