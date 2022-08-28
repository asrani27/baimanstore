@extends('front.app')

@section('content')
<br/>

<div class="row">
  <div class="col-md-8">
    
    <div class="row">
      @foreach ($produk as $item)              
      <div class="col-md-3">
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <a href="/produk/{{$item->id}}/detail">
          <div class="widget-user-header text-white" style="background: url('/storage/{{$item->toko_id}}/{{$item->foto}}') center center; height:160px; background-size:cover;">
          </div>
          </a>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                  <span class="text-secondary text-bold"><a href="/produk/{{$item->id}}/detail" class="text-muted">{{$item->nama}}</a></span><br/>
                  <span class="text-danger text-bold">Rp. {{number_format($item->harga)}}</span>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-info">
        <h3 class="widget-user-username">{{$pengrajin->nama_toko}}</h3>
        <h5 class="widget-user-desc">{{$pengrajin->deskripsi}}</h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="/theme/toko.jpg" alt="User Avatar">
      </div>
      <div class="card-footer p-0">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a href="#" class="nav-link">
              Total Produk <span class="float-right badge bg-primary">{{$pengrajin->produk->count()}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              Nama Pemilik <span class="float-right badge bg-info">{{$pengrajin->nama_pemilik}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              Alamat <span class="float-right badge bg-success">{{$pengrajin->alamat}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              Telp <span class="float-right badge bg-danger">{{$pengrajin->telp}}</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection