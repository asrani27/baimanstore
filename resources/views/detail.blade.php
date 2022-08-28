@extends('front.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3 class="d-inline-block d-sm-none">{{$produk->nama}}</h3>
            <div class="col-12">
              <img src="/storage/{{$produk->toko_id}}/{{$produk->foto}}" class="product-image" alt="Product Image">
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3">{{$produk->nama}}</h3>
            <p>{!!$produk->deskripsi!!}</p>

            <hr>

            <div class="bg-gray py-2 px-3 mt-4">
              <h2 class="mb-0">
                Rp. {{number_format($produk->harga)}},-
              </h2>
            </div>

            <div class="mt-4">
              <div class="btn btn-primary btn-lg btn-flat">
                <i class="fas fa-phone fa-lg mr-2"></i>
                {{$produk->toko->telp}}
              </div>

              <div class="btn btn-default btn-lg btn-flat">
                <i class="fas fa-user fa-lg mr-2"></i>
                {{$produk->toko->nama_toko}}
              </div>
            </div>

            <div class="mt-4 product-share">
                Alamat Toko : {{$produk->toko->alamat_toko}}<br/>
                <div id="mapiddetail"></div>
            </div>

          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">Produk Lainnya</h3>
          <div class="card-tools">
              
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    @foreach ($data as $item)              
    <div class="col-md-2">
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
                {{-- <span class="text-danger text-bold">Rp. {{number_format($item->harga)}}</span> --}}
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection