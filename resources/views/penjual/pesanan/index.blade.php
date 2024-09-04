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
                <th>Bukti Pembayaran</th>
                <th>Resi Pengiriman</th>
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
                        @if ($item->upload == null)
                            -
                        @else
                            <a href="/storage/nota/compress/{{$item->upload}}" target="_blank"><i class="fa fa-download"></i> Lihat Bukti</a>
                        @endif    
                        </td>
                        <td>
                            @if ($item->jasa == null)
                                -
                            @else
                                {{$item->jasa}} - {{$item->resi}}  
                            @endif
                        </td>
                    <td>
                    @if ($item->status == 0)
                        <span class="badge badge-info">di proses</span>
                    @elseif($item->status == 1)
                        <span class="badge badge-success">Selesai</span>
                    @else
                    @endif    
                    </td>
                    <td>
                        <a href="#" class="btn btn-xs btn-primary upload-nota" data-id="{{$item->id}}"><i class="fas fa-upload"></i> Input Nomor Resi</a>
                        @if($item->status != 1)
                            @if ($item->jasa != null)
                                
                            @else
                                <a href="/penjual/pesanan/{{$item->id}}/cancel" class="btn btn-xs btn-danger" onclick="return confirm('yakin di cancel?');"><i class="fas fa-trash"></i> Cancel</button>   
                            @endif 
                        @endif 
                    
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

<div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/penjual/nomorresi" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">MASUKKAN NO RESI</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Jasa Pengiriman</label>
                        <select class="form-control" name="jasa" required>
                            <option value="jnt">JNT</option>
                            <option value="jne">JNE</option>
                            <option value="sicepat">SICEPAT</option>
                        </select>
                        <input type="hidden" class="form-control" id="penjualan_id" name="penjualan_id" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nomor Resi</label>
                        <input type="text" class="form-control" name="resi" required>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-paper-plane"></i>
                        Input</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')

<script>
    $(document).on('click', '.upload-nota', function() {
   $('#penjualan_id').val($(this).data('id'));
   $("#modal-edit").modal();
});
</script>
@endpush