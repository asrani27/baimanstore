@extends('front.app')

@section('content')
<form method="get" action="/produk/cari">
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <select class="form-control" name="kategori_id">
        <option value="">-Kategori-</option>
        @foreach ($kategori as $item)
        <option value="{{$item->id}}" {{old('kategori_id') == $item->id ? 'selected':''}}>{{$item->nama}}</option>                    
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <div class="input-group input-group">
          <input type="search" class="form-control" placeholder="Pencarian" value="{{old('search')}}"  name="search" required>
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
      <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">Hasil Pencarian Produk : {{old('search')}}</h3>

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