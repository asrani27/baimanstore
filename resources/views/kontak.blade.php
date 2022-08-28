@extends('front.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
         <h5>Telp</h5> {{$profil->telp}}<br/><br/>
         <h5>WhatsApp</h5> {{$profil->wa}}<br/><br/>
         <h5>Email</h5> {{$profil->email}}<br/><br/>
         <h5>Facebook</h5> {{$profil->facebook}}<br/><br/>
         <h5>Instagram</h5> {{$profil->ig}}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@endsection