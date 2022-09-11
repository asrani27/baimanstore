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
            <h3 class="card-title">Detail Transaksi</h3>
            <div class="card-tools">
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                </tr>
            </thead>
            @php
                $no =1;
            @endphp
            <tbody>
            @foreach ($data as $key => $item)
                    <tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
                    <td>{{$no++}}</td>
                    <td>{{$item->nama_barang}}</td>
                    <td>{!!$item->deskripsi!!}</td>
                    <td>{{$item->jumlah}}</td>
                    <td>{{number_format($item->harga)}}</td>
                    <td>{{number_format($item->jumlah * $item->harga)}}</td>
                
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>GrandTotal</td>
                    <td>{{number_format($data->sum('total'))}}</td>
                </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
    </div>
</div>



@endsection

@push('js')

@endpush