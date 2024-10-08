<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/img/icon.png') }}" width="30" height="40" alt="icon">
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/img/icon.png') }}" width="30" height="40" alt="icon">
        </a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Main Menu</li>
        <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fire"></i>
                <span>Dashboard</span>
            </a>
        </li>
        {{--  aktifkan ini jika mau dropdown  --}}
        {{-- <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i>
                <span>Dropdown Menu</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">Dropdown Item</a></li>
            </ul>
        </li> --}}

        {{-- sidebar superadmin  --}}
        {{--  @can('superadmin')
        <li class="menu-header">Administrator</li>
        @endcan  --}}

        {{-- sidebar admin  --}}
        @can('admin')
        <li class="menu-header">Administrator</li>
        <li class="{{ Route::is('user*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola User</span>
            </a>
        </li>
        <li class="{{ Route::is('products*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('products.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola Products</span>
            </a>
        </li>
        <li class="{{ Route::is('metode*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('metode.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola Metode</span>
            </a>
        </li>
        <li class="{{ Route::is('voucher*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('voucher.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola Voucher</span>
            </a>
        </li>
        <li class="{{ Route::is('transaksis*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transaksis.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola Transaksis</span>
            </a>
        </li>
        <li class="{{ Route::is('ulasan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('ulasan.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola Ulasan</span>
            </a>
        </li>
        @endcan

        {{-- sidebar user  --}}
        @can('user')
        <li class="menu-header">User</li>
        @endcan
    </ul>
</aside>