
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
        <a href="/pembeli/home" class="nav-link {{Request::is('pembeli/home') ? 'active' : ''}}">
            <i class="nav-icon fas fa-home"></i>
            <p>
            Beranda
            </p>
        </a>
        </li>
        <li class="nav-item">
        <a href="/pembeli/keranjangsaya" class="nav-link {{Request::is('pembeli/keranjangsaya') ? 'active' : ''}}">
            <i class="nav-icon fa fa-shopping-cart"></i>
            <p>
            Keranjang Belanja
            </p>
        </a>
        </li>
    
        <li class="nav-item">
            <a href="/pembeli/riwayatbelanja" class="nav-link {{Request::is('pembeli/riwayatbelanja') ? 'active' : ''}}">
                <i class="nav-icon fa fa-th"></i>
                <p>
                Riwayat Belanja
                </p>
            </a>
            </li>
        <li class="nav-item">
        <a href="/pembeli/gantipass" class="nav-link {{Request::is('pembeli/gantipass') ? 'active' : ''}}">
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