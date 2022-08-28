@extends('front.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
          {!!$profil->tentang_kami!!}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@endsection