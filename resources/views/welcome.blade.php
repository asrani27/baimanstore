@extends('front.app')

@section('content')

<form method="get" action="/produk/cari">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <select class="form-control" name="kategori_id">
          <option value="">-Kategori-</option>
          @foreach ($kategori as $item)
          <option value="{{$item->id}}">{{$item->nama}}</option>                    
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <div class="input-group input-group">
            <input type="search" class="form-control" placeholder="Pencarian" value=""  name="search" required>
            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    </div>
  </div>
  </form>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner text-center">
            {{-- <div class="carousel-item active">
              <video  width="100%" height="400" autoplay loop muted controls>
                <source src="/theme/welcome.mp4" type="video/mp4" />
              </video>
            </div> --}}
            @foreach ($banner as $item)
                
            <div class="carousel-item {{$item->id == 1 ? 'active':''}}">
              @if ($item->foto == null)
              <img class="d-block w-100" src="https://p0.piqsels.com/preview/378/771/661/romania-cluj-napoca-wallpaper-hd.jpg" height="400px">
              @else
              <img class="d-block w-100" src="/storage/banner/{{$item->foto}}" height="400px">
              @endif
            </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>

<div style="padding-bottom: 10px;">
  <h3>KOMODITAS BARANG</h3>
</div>
<div class="row">
  @foreach ($kategoriBarang as $item)
  <div class="col-lg-1 col-3">
    <!-- small box -->
    <a href="/kategori/{{$item->id}}/detail">
    <div class="small-box bg-gradient-info text-center">
      <div class="inner">
        
        @if ($item->foto == null)
        <img src="https://sosialita.tanahlautkab.go.id/assets/uploads/kategoriproduksub/pbf9Kgut20210713103513.png" alt="User Image">
        @else
            <img src="/storage/kategori/compress/{{$item->foto}}" width="80%;">
        @endif
        
        <p style="font-size: 12px; padding-top:10px">{{Str::limit($item->nama, 20)}}
          @if (Str::length($item->nama) < 13)
              
          @else    
          
          @endif</p>
      </div>
    </div>
  </a>
  </div>
  @endforeach
</div>

<div style="padding-bottom: 10px;">
  <h3>KOMODITAS JASA</h3>
</div>
<div class="row">
  @foreach ($kategoriJasa as $item)
  <div class="col-lg-1 col-3">
    <!-- small box -->
    <a href="/kategori/{{$item->id}}/detail">
    <div class="small-box bg-gradient-info text-center">
      <div class="inner">
        @if ($item->foto == null)
        <img src="https://sosialita.tanahlautkab.go.id/assets/uploads/kategoriproduksub/pbf9Kgut20210713103513.png" alt="User Image">
        @else
        <img src="/storage/kategori/compress/{{$item->foto}}" width="80%;">
        @endif
        <p style="font-size: 12px; padding-top:10px">{{Str::limit($item->nama, 20)}}
          @if (Str::length($item->nama) < 13)
             
          @else    
          
          @endif
        </p>
      </div>
    </div>
  </a>
  </div>
  @endforeach
</div>



<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">Produk Terbaru</h3>

        <div class="card-tools">
          <a href="/semuaproduk" class="btn float-right btn-xs bg-gradient-success"><i class="fa fa-search"></i> Lihat Semua</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  @foreach ($produk as $item)              
  <div class="col-md-2">
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <a href="/produk/{{$item->id}}/detail">
      <div class="widget-user-header text-white" style="background: url('/storage/toko_{{$item->toko_id}}/compress/{{$item->foto}}') center center; height:160px; background-size:cover;">
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
<div class="row">          
  <div class="col-md-12 text-centre">
    {{$produk->links()}}
  </div>
</div>
@endsection