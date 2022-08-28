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
        <a href="/user/produksaya/create" class="btn btn-sm bg-gradient-purple"><i class="fas fa-plus"></i> Tambah</a>
        <br/><br/>
        <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Produk</h3>
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
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Toko</th>
                <th>Tanggal</th>
                <th>Aksi</th>
                </tr>
            </thead>
            @php
                $no =1;
            @endphp
            <tbody>
            @foreach ($data as $key => $item)
                    <tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>
                        @if ($item->foto == null)
                        <img class="direct-chat-img" src="/theme/dist/img/default-150x150.png" alt="message user image">
                        @else
                        <a href="/storage/{{$item->foto}}" target="_blank"><img class="direct-chat-img" src="/storage/{{$item->toko_id}}/{{$item->foto}}" alt="message user image"></a>
                            
                        @endif
                    </td>
                    <td>{{$item->nama}}</td>
                    <td>Rp. {{number_format($item->harga)}}</td>
                    <td>{{$item->toko->nama_toko}}</td>
                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</td>
                    <td>
                        
                    <form action="/user/produksaya/{{$item->id}}" method="post">
                        <a href="/user/produksaya/{{$item->id}}/edit" class="btn btn-xs btn-success"><i class="fas fa-edit"></i> Edit</a>
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('yakin DI Hapus?');"><i class="fas fa-trash"></i> Delete</button>     
                    </form>

                    </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
        {{$data->links()}}
    </div>
</div>

@endsection

@push('js')
@endpush