
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
    <a href="/penjual/home" class="nav-link {{Request::is('penjual/home') ? 'active' : ''}}">
        <i class="nav-icon fas fa-home"></i>
        <p>
        Beranda
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/penjual/produksaya" class="nav-link {{Request::is('penjual/produksaya') ? 'active' : ''}}">
        <i class="nav-icon fa fa-shopping-cart"></i>
        <p>
        Produk Saya
        </p>
    </a>
    </li>

    <li class="nav-item">
        <a href="/penjual/pesanan" class="nav-link {{Request::is('penjual/pesanan') ? 'active' : ''}}">
            <i class="nav-icon fa fa-th"></i>
            <p>
            Pesanan Masuk
            </p>
            @if (pesananMasuk() != 0)
                
            <span class="right badge badge-danger">{{pesananMasuk()}}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
    <a href="/penjual/gantipass" class="nav-link {{Request::is('penjual/gantipass') ? 'active' : ''}}">
        <i class="nav-icon fas fa-key"></i>
        <p>
        Ganti Password
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/logout" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>
        Logout
        </p>
    </a>
    </li>
</ul>
</nav>