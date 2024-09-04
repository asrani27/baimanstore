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
                <th>Total</th>
                <th>Bukti Pembayaran</th>
                <th>Nota</th>
                <th>Status</th>
                <th>Aksi</th>
                </tr>
            </thead>
            @php
                $no =1;
            @endphp
            <tbody>
            @foreach ($data as $key => $item)
                    <tr style="font-size:14px; font-family:Arial, Helvetica, sans-serif">
                    <td>{{$no++}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->toko->nama_toko}}</td>
                    <td>{{number_format($item->total)}}</td>
                    <td>
                    @if ($item->upload == null)
                        -
                    @else
                        <a href="/storage/nota/compress/{{$item->upload}}" target="_blank"><i class="fa fa-download"></i></a>
                    @endif    
                    </td>
                    <td>
                    @if ($item->nota == null)
                        -
                    @else
                        <a href="/storage/nota/compress/{{$item->nota}}" target="_blank"><i class="fa fa-download"></i></a>
                    @endif    
                    </td>
                    <td>
                        @if ($item->status == 0)
                            <span class="badge badge-info">Di Proses</span>
                        @elseif($item->status == 1)
                            <span class="badge badge-success">Di terima</span>
                        @else
                            <span class="badge badge-danger">Di Batalkan</span>
                        @endif
                    </td>
                    <td>
                        <a href="/user/riwayatbelanja/{{$item->id}}/diterima" class="btn btn-xs btn-primary"  onclick="return confirm('yakin di pesanan anda sudah diterima?');">Diterima</a>
                        <a href="/user/riwayatbelanja/{{$item->id}}/detail" class="btn btn-xs btn-primary">Detail</a>
                        <a href="#" class="btn btn-xs btn-primary upload-nota" data-id="{{$item->id}}">Upload Bukti</a>
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



<div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/user/uploadnota" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">UPLOAD BUKTI PEMBAYARAN</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>File</label>
                        <input type="file" class="form-control" name="file" required>
                        <input type="hidden" class="form-control" id="penjualan_id" name="penjualan_id" readonly>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-paper-plane"></i>
                        Upload</button>
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