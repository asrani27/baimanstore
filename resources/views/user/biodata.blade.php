@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    BIODATA PEGAWAI
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <tr>
            <td>
              <div class="btn-group">
                <a href="/pegawai/biodata" class="btn bg-gradient-{{$page == 'profil' ? 'danger':'info'}}"><i class="fas fa-user"></i> Profil</a>
                <a href="/pegawai/pasangan" class="btn bg-gradient-{{$page == 'pasangan' ? 'danger':'info'}}"><i class="fas fa-list"></i> Pasangan</a>
                <a href="/pegawai/anak" class="btn bg-gradient-{{$page == 'anak' ? 'danger':'info'}}"><i class="fas fa-list"></i> Anak</a>
                <a href="/pegawai/orangtua" class="btn bg-gradient-{{$page == 'orangtua' ? 'danger':'info'}}"><i class="fas fa-list"></i> Orang Tua</a>
                <a href="/pegawai/pendidikan" class="btn bg-gradient-{{$page == 'pendidikan' ? 'danger':'info'}}"><i class="fas fa-list"></i> Pendidikan</a>
              </div>
            </td>
        </tr>
    </div>
</div>
<br/>
<div class="row">
    @include('pegawai.detail.'.$page)
    <div class="col-lg-2 col-md-6">
        <div class="card">
            <div class="card-header bg-gradient-secondary">
                <i class="fas fa-book"></i> Kepegawaian
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Pensiun</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Naik Gaji</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Naik Pangkat</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Jabatan</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Kepangkatan</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Hukuman</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Diklat</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Penghargaan</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Penugasan LN</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Seminar</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Cuti</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="/pegawai/biodata/foto" enctype="multipart/form-data">
            @csrf
        <div class="modal-header bg-gradient-secondary" style="padding:10px">
            <h4 class="modal-title text-sm">Upload Foto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
            <p>Max 10MB</p>
            <input type="file" name="file" required>
        </div>
        
        <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-image"></i> Upload</button>
        </div>
        </form>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush