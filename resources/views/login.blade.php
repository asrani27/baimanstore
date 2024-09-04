<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IKM KAPUAS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/theme/dist/css/adminlte.min.css">
  @toastr_css
</head>
<body class="hold-transition login-page" style="background-image: url('/theme/bg.jpg'); background-size: cover;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="/" class="h1">IKM KAPUAS</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Industri Kecil Menengah</p>

      <form class="form" action="/login" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" value="{{old('username')}}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" class="form-control" name="password" placeholder="password" value="{{old('password')}}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <div class="col-6">
            <a href="/register" class="btn btn-danger btn-block">Register</a>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/theme/dist/js/adminlte.min.js"></script>

@toastr_js
@toastr_render
</body>
</html>
