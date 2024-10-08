<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    @include('includes.style')
    @stack('styles')
</head>

<body class="layout-3">
    <div id="app">
        <div class="">
            <div class="navbar-bg" style="position: fixed; z-index: 100;"></div>


            <nav class="navbar navbar-expand-lg main-navbar" style="position: fixed; z-index: 100;">
                @include('includes.navbar_client')
            </nav>

            <!-- Main Content -->
            <div class="main-content-client" style="min-height: 85vh">
                <section class="section">
                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                @include('includes.footer')
            </footer>
        </div>
    </div>

    @include('includes.script')
    @stack('scripts')
</body>

</html>
