<style>
    .btn-register:hover {
        color: #ccff33 !important;
    }

    .nav-link:hover {
        color: #ccff33 !important;
    }

    .nav-active {
        color: #ccff33 !important;
    }
</style>

<nav class="navbar navbar-expand-lg main-navbar">
    <a href="index.html" class="navbar-brand sidebar-gone-hide">Laundry</a>
    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    <div class="nav-collapse">
        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="/" class="nav-link {{ Route::is('beranda') ? 'nav-active' : '' }}">Beranda</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('product') }}"
                    class="nav-link {{ Route::is('product') ? 'nav-active' : '' }}">Product</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('client_voucher') }}"
                    class="nav-link {{ Route::is('client_voucher') ? 'nav-active' : '' }}">Voucher</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('hubungi') }}" class="nav-link {{ Route::is('hubungi') ? 'nav-active' : '' }}">Hubungi
                    Kami</a>
            </li>
        </ul>
    </div>
    <form class="form-inline ml-auto"></form>
    <ul class="navbar-nav navbar-right">

        @if (auth()->user())
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('client_profile') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <a href="features-activities.html" class="dropdown-item has-icon">
                        <i class="fas fa-bolt"></i> Aktivitas
                    </a>
                    @if (auth()->user()->role == 'admin')
                        <a href="{{route('dashboard')}}" class="dropdown-item has-icon">
                            <i class="fas fa-bolt"></i> dashboard
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="dropdown-item has-icon text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                </div>
            </li>
        @else
            <div>
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-register"
                    style="color: white; background-color: transparent">
                    Register
                </a>
            </div>
        @endif

    </ul>
</nav>


{{-- <nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a href="index-0.html" class="nav-link">General Dashboard</a></li>
                    <li class="nav-item"><a href="index.html" class="nav-link">Ecommerce Dashboard</a></li>
                </ul>
            </li>
            <li class="nav-item active">
                <a href="#" class="nav-link"><i class="far fa-heart"></i><span>Top Navigation</span></a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                        class="far fa-clone"></i><span>Multiple Dropdown</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a href="#" class="nav-link">Not Dropdown Link</a></li>
                    <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Hover Me</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                            <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Link 2</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="#" class="nav-link">Link 3</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav> --}}
