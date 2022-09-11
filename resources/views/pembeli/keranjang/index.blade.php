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
        <a href="/" class="btn btn-sm bg-gradient-purple"><i class="fas fa-plus"></i> Tambah Belanja</a>
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
                <th>Tanggal</th>
                <th>Toko</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
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
                    <td>{{$item->produk->toko->nama_toko}}</td>
                    <td>{{$item->produk->nama}}</td>
                    <td>{{number_format($item->harga)}}</td>
                    <td>
                        {{$item->jumlah}}

                        <a href="#" class="btn btn-xs edit-jumlah" data-id="{{$item->id}}"
                            data-jumlah="{{$item->jumlah}}">
                            <i class="fas fa-edit text-primary"></i></a>
                    </td>
                    <td>{{number_format($item->total)}}</td>
                    <td>
                        <a href="/pembeli/keranjangsaya/{{$item->id}}/delete" class="btn btn-xs btn-danger" onclick="return confirm('Yakin Ingin Di Hapus?');"><i class="fas fa-trash"></i></a>
                    </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Grand Total</td>
                    <td>{{$data->sum('jumlah')}}</td>
                    <td>{{number_format($data->sum('total'))}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="/pembeli/checkout" class="btn btn-sm btn-success"> Checkout <i class="fas fa-arrow-right"></i></a>
                    </td>
                    <td></td>
                </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
    </div>
</div>


<div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/pembeli/keranjangsaya/update" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">EDIT JUMLAH</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Jumlah Item</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah" required>
                        <input type="hidden" class="form-control" id="keranjang_id" name="keranjang_id" readonly>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-paper-plane"></i>
                        Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')

<script>
    $(document).on('click', '.edit-jumlah', function() {
   $('#keranjang_id').val($(this).data('id'));
   $('#jumlah').val($(this).data('jumlah'));
   $("#modal-edit").modal();
});
</script>
@endpush