@extends('front.app2')

@section('content')
<br/>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">Daftar Sebagai</h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Pembeli</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Penjual</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                    <form method="post" action="/daftar/pembeli">
                    @csrf
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">NAMA</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama" id="inputEmail3" placeholder="NAMA" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">EMAIL</label>
                            <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="EMAIL" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">USERNAME</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="inputEmail3" placeholder="username" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">PASSWORD</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="inputEmail3" placeholder="password" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">MASUKKAN PASSWORD LAGI</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" name="confirm_password" id="inputEmail3" placeholder="masukkan password" required>
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class='btn btn-block btn-md btn-success'>DAFTAR SEBAGAI PEMBELI</button>
                            </div>
                        </div>
                    </form>                  
                  </div>

                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                    <form method="post" action="/daftar/penjual">
                        @csrf
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">NAMA</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama" id="inputEmail3" placeholder="NAMA" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">EMAIL</label>
                                <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="EMAIL" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">USERNAME</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" id="inputEmail3" placeholder="username" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">PASSWORD</label>
                                <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="inputEmail3" placeholder="password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">MASUKKAN PASSWORD LAGI</label>
                                <div class="col-sm-9">
                                <input type="password" class="form-control" name="confirm_password" id="inputEmail3" placeholder="masukkan password" required>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class='btn btn-block btn-md btn-danger'>DAFTAR SEBAGAI PENJUAL</button>
                                </div>
                            </div>  
                        </form> 
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@endsection