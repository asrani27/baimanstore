
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
    <a href="/user/home" class="nav-link {{Request::is('user/home') ? 'active' : ''}}">
        <i class="nav-icon fas fa-home"></i>
        <p>
        Beranda
        </p>
    </a>
    </li>

    <li class="nav-header">PEMBELIAN SAYA</li>
    <li class="nav-item">
        <a href="/user/keranjangsaya" class="nav-link {{Request::is('user/keranjangsaya*') ? 'active' : ''}}">
            <i class="nav-icon fa fa-shopping-cart"></i>
            <p>
            Keranjang Belanja
            </p>
        </a>
    </li>
    
    <li class="nav-item">
        <a href="/user/riwayatbelanja" class="nav-link {{Request::is('user/riwayatbelanja*') ? 'active' : ''}}">
            <i class="nav-icon fa fa-th"></i>
            <p>
            Riwayat Belanja
            </p>
        </a>
    </li>
    <li class="nav-header">PENJUALAN SAYA</li>
    
    <li class="nav-item">
    <a href="/user/tokosaya" class="nav-link {{Request::is('user/tokosaya') ? 'active' : ''}}">
        <i class="nav-icon fa fa-th"></i>
        <p>
        Profil Toko Saya
        </p>
    </a>
    </li>

    <li class="nav-item">
    <a href="/user/produksaya" class="nav-link {{Request::is('user/produksaya') ? 'active' : ''}}">
        <i class="nav-icon fa fa-shopping-cart"></i>
        <p>
        Produk Saya
        </p>
    </a>
    </li>

    <li class="nav-item">
        <a href="/user/pesanan" class="nav-link {{Request::is('user/pesanan') ? 'active' : ''}}">
            <i class="nav-icon fa fa-th"></i>
            <p>
            Pesanan Masuk
            </p>
            @if (pesananMasuk() != 0)
                
            <span class="right badge badge-danger">{{pesananMasuk()}}</span>
            @endif
        </a>
    </li>

    <li class="nav-header">SETTING</li>
    <li class="nav-item">
    <a href="/user/gantipass" class="nav-link {{Request::is('user/gantipass') ? 'active' : ''}}">
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