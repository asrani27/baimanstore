
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
    <a href="/superadmin/home" class="nav-link {{ Request::is('superadmin/home*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
        Beranda
        </p>
    </a>
    </li>
    <li class="nav-header">DATA UTAMA</li>
    <li class="nav-item">
        <a href="/superadmin/kategori" class="nav-link {{ Request::is('superadmin/kategori*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Kategori Produk
            </p>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a href="/superadmin/pembeli" class="nav-link {{ Request::is('superadmin/pembeli*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Pembeli
            </p>
        </a>
    </li> --}}
    <li class="nav-item">
        <a href="/superadmin/toko" class="nav-link {{ Request::is('superadmin/toko*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
                UMKM / Penjual
            </p>
        </a>
    </li>

    <li class="nav-item">
    <a href="/superadmin/produk" class="nav-link {{ Request::is('superadmin/produk*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>
            Produk
        </p>
    </a>
    </li>
    
    <li class="nav-item">
    <a href="/superadmin/banner" class="nav-link {{ Request::is('superadmin/Banner*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-image"></i>
        <p>
        Banner
        </p>
    </a>
    </li>

    <li class="nav-item">
    <a href="/superadmin/profildinas" class="nav-link {{ Request::is('superadmin/profildinas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file"></i>
        <p>
            Profil Dinas
        </p>
    </a>
    </li>

    {{-- <li class="nav-header">LAPORAN</li>
    <li class="nav-item">
    <a href="/superadmin/laporan/transaksi" class="nav-link">
        <i class="nav-icon fas fa-file"></i>
        <p>
        Transaksi
        </p>
    </a>
    </li> --}}

    <li class="nav-header">SETTING</li>
    <li class="nav-item">
    <a href="/superadmin/gantipass" class="nav-link">
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