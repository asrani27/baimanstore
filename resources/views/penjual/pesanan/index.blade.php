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
            <h3 class="card-title">Data Pesanan</h3>
            <div class="card-tools">
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Pembeli</th>
                <th>Detail Barang Yang Di beli</th>
                <th>Total</th>
                <th>Status</th>
                </tr>
            </thead>
            @php
                $no =1;
            @endphp
            <tbody>
            @foreach ($data as $key => $item)
                    <tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->pembeli->nama}}</td>
                    <td>
                        @foreach ($item->detail as $item2)
                            <li>{{$item2->nama_barang}} ({{$item2->jumlah}} * {{number_format($item2->harga)}}) = {{number_format($item2->total)}}</li>
                        @endforeach
                    </td>
                    <td>{{number_format($item->detail->sum('total'))}}</td>
                    <td>
                    @if ($item->status == 0)
                        <span class="badge badge-info">di proses</span>
                    @elseif($item->status == 1)
                        <span class="badge badge-success">Selesai</span>
                    @else
                        <span class="badge badge-danger">Cancel</span>

                    @endif    
                    </td>
                    <td>
                        
                    <form action="/penjual/pesanan/{{$item->id}}" method="post">
                        <a href="#" class="btn btn-xs btn-primary"><i class="fas fa-upload"></i> Upload Nota</a>
                        
                        <a href="/penjual/pesanan/{{$item->id}}/cancel" class="btn btn-xs btn-danger" onclick="return confirm('yakin di cancel?');"><i class="fas fa-trash"></i> Cancel</button>     
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