<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IKM KAPUAS</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/theme/plugins/fontawesome-free/css/all.min.css">
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
        {{-- <img src="/theme/logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">IKM KAPUAS</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav text-bold">
          <li class="nav-item">
            <a href="/" class="nav-link"><i class="fas fa-home"></i> Kembali</a>
          </li>
          <li class="nav-item">
            <a href="/daftar" class="nav-link"><i class="fas fa-edit"></i> Daftar</a>
          </li>
        </ul>

      </div>
      
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

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
    <div class="row text-center">
      <div class="col-md-12">
        <strong>PEMKO BANJARMASIN</strong> 
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

</body>
</html>
