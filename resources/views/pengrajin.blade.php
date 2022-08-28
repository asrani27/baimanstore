@extends('front.app')

@section('content')
<br/>
<div class="row">
  <div class="col-md-12">
  <div class="form-group">
    <div class="input-group input-group">
        <input type="search" class="form-control" placeholder="CARI PENGRAJIN" value="" name="search" required="">
        <div class="input-group-append">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card card-solid">
      <!-- /.card-header -->
      <div class="card-body pb-1">
        <div class="row">
          @foreach ($pengrajin as $item)
              
          <div class="col-12 col-sm-4 col-md-3 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-body pt-1">
                <div class="row">
                  <div class="col-12">
                    {{-- <img src="/storage/{{$item->foto}}" alt="user-avatar" class="img-circle img-fluid" width="60px"> --}}
                    <h2 class="lead"><b>{{$item->nama_toko}}</b></h2>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: {{$item->alamat}}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telp : {{$item->telp}}</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-left">
                  <a href="/pengrajin/produk/{{$item->id}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-shopping-cart"></i> Total Produk : {{$item->produk->count()}}
                  </a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@endsection