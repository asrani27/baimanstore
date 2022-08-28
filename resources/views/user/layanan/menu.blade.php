<div class="col-lg-3 col-md-6">
    <div class="card">
        <div class="card-header bg-gradient-secondary">
            <i class="fas fa-book"></i> Layanan BKD
        </div>
        <div class="card-body">
            <a href="/pegawai/home" class="btn btn-block btn-outline-info text-left"><i class="fas fa-home"></i> Beranda</a>
            @foreach ($layanan as $item)
            <a href="/pegawai/home/{{$item->id}}/layanan" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> {{$item->nama}}</a>
            @endforeach
        </div>
    </div>
</div>