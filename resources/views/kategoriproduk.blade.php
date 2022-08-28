@extends('front.app')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">Menampilkan Produk : {{$namaKategori == null ? '': $namaKategori->nama}}</h3>

        <div class="card-tools">
            
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
<div class="row">          
  <div class="col-md-12 text-centre">
    {{$produk->links()}}
  </div>
</div>
@endsection