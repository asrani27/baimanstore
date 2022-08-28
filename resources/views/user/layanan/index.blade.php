@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    LAYANAN {{strtoupper($detailLayanan->nama)}}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-9 col-md-6">
      <div class="card">
        <div class="card-header bg-gradient-secondary">
          <h3 class="card-title">Layanan {{$detailLayanan->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <form method="post" action="/pegawai/home/{{$detailLayanan->id}}/layanan">
        @csrf
        <div class="card-body table-responsive">
            <div class="alert alert-warning alert-dismissible">
            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
            Di Bawah ini adalah persyaratan yang harus di upload, jika tidak ada dalam pilihan, silahkan upload file nya terlebih dahulu,
          </div>
            @foreach ($detailLayanan->persyaratan as $syarat)
            <div class="form-group">
                <label>{{$syarat->nama}}</label>
                <select class="form-control" name="syarat[]" required>
                    <option value="">--pilih--</option>
                    @foreach (listUpload($pegawai->id, $syarat->id) as $myFile)
                    <option value="{{$myFile->id}}">{{$myFile->nama}}</option>
                    @endforeach
                </select>
            </div>
            @endforeach
            <button type="submit" class="btn btn-sm btn-block btn-outline-primary"><i class="fa fa-paper-plane"></i> Ajukan</button>
        </div>
        </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    @include('pegawai.layanan.menu')
</div>
@endsection

@push('js')

@endpush