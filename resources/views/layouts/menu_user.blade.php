
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
    <li class="nav-item">
    <a href="/user/produksaya" class="nav-link {{Request::is('user/produksaya') ? 'active' : ''}}">
        <i class="nav-icon fa fa-shopping-cart"></i>
        <p>
        Produk Saya
        </p>
    </a>
    </li>

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