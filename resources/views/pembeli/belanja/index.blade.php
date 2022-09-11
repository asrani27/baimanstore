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
            <h3 class="card-title">Riwayat Transaksi</h3>
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
                <th>Toko</th>
                <th>Pembeli</th>
                <th>Total</th>
                <th>Status</th>
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
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->toko->nama_toko}}</td>
                    <td>{{$item->pembeli->nama}}</td>
                    <td>{{number_format($item->total)}}</td>
                    <td>
                        @if ($item->status == 0)
                            Di Proses
                        @elseif($item->status == 1)
                            Selesai
                        @else
                            Di Batalkan
                        @endif
                    </td>
                    <td>
                        <a href="/pembeli/riwayatbelanja/{{$item->id}}/detail" class="btn btn-xs btn-primary">Detail</a>
                        <a href="/pembeli/riwayatbelanja/{{$item->id}}/upload" class="btn btn-xs btn-primary">Upload</a>
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