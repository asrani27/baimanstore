@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    ADMIN
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-header">
            <h3 class="card-title">Banner</h3>
            <div class="card-tools">
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                <th>#</th>
                <th>Gambar</th>
                <th>Aksi</th>
                </tr>
            </thead>
            @php
                $no =1;
            @endphp
            <tbody>
            @foreach ($data as $key => $item)
                    <tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
                    <td>{{$no++}}</td>
                    <td>
                        @if ($item->foto == null)
                        <img class="direct-chat-img" src="/theme/dist/img/default-150x150.png" alt="message user image">
                        @else
                        <a href="/storage/banner/{{$item->foto}}" target="_blank"><img class="" src="/storage/banner/{{$item->foto}}" height="150px" width="600px"></a>
                            
                        @endif
                    </td>
                    <td>
                        
                    <form action="/superadmin/banner/{{$item->id}}" method="post">
                        <a href="/superadmin/banner/{{$item->id}}/edit" class="btn btn-xs btn-success"><i class="fas fa-edit"></i> Ganti Banner</a>
                    </form>

                    </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
    </div>
</div>

@endsection

@push('js')
@endpush