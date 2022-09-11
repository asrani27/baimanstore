@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
@section('title')
    EDIT
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <a href="/superadmin/produk" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a><br/><br/>
<form method="post" action="/superadmin/produk/{{$data->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-body">                   
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Toko</label>
                    <div class="col-sm-10">
                        <select name="toko_id" class="form-control" required>
                            <option value="">-toko-</option>
                            @foreach ($toko as $item)
                            <option value="{{$item->id}}" {{$data->toko_id == $item->id ? 'selected':''}}>{{$item->nama_toko}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <select name="kategori_id" class="form-control" required>
                            <option value="">-kategori-</option>
                            @foreach ($kategori as $item)
                            <option value="{{$item->id}}" {{$data->kategori_id == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" required value="{{$data->nama}}">
                    </div>
                    </div>

                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="harga" required value="{{$data->harga}}"  onkeypress="return hanyaAngka(event)"/>
                    </div>
                    </div>
                    
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Deskripsi Produk</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi" class="form-control" required id="summernote">{{$data->deskripsi}}</textarea>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto">
                    </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Publish</label>
                        <div class="col-sm-10">
                            <select name="publish" class="form-control">
                                <option value="1" {{$data->publish == 1 ? 'selected':''}}>YA</option>
                                <option value="0" {{$data->publish == 0 ? 'selected':''}}>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-block btn-primary"><strong>UPDATE</strong></button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    </div>
</div>

@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
@endpush