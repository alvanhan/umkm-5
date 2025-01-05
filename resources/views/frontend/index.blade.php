<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta content="Makanan Khas Indonesia" name="Makanan Khas Indonesia">
    <meta name="google" content="notranslate" />
    <meta content="Selera Kampung" name="author">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{ asset('frontend/assets/apple-icon-180x180.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('favicon.ico')}}" rel="icon">
    <title>Selera Kampung</title>
    <link href="{{ asset('frontend/main.82cfd66e.css')}}" rel="stylesheet">
</head>

<body>

    <!-- Add your content of header -->
    <header class="">
        <div class="navbar navbar-default visible-xs">
            <button type="button" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{route('index')}}" class="navbar-brand">Selera Kampung</a>
        </div>

        <nav class="sidebar">
            <div class="navbar-collapse" id="navbar-collapse">
                <div class="site-header hidden-xs">
                    <a class="site-brand" href="{{route('index')}}" title="">
                        <img class="img-responsive site-logo" alt="" src="{{ asset('frontend/assets/images/mashup-logo.svg')}}">
                        Selera Kampung
                    </a>
                    <p>Temukan berbagai macam makanan khas Indonesia</p>
                </div>
                <ul class="nav">
                    <li><a href="{{route('menu.index')}}" title="">Pilihan Menu</a></li>
                    <li><a href="#" title="">Tentang Kami</a></li>
                    <li><a href="#" title="">Kontak Kami</a></li>
                    {{-- <li><a href="#" title="">Services</a></li>
                    <li><a href="#" title="">Components</a></li> --}}

                </ul>

                <nav class="nav-footer">
                    <p>© Untitled | Selera Kampung</p>
                </nav>
            </div>
        </nav>
    </header>
    <main class="" id="main-collapse">
        @yield('content')

        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                masonryBuild();
            });
        </script>

    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            navbarToggleSidebar();
            navActivePage();
        });
    </script>
    <script type="text/javascript" src="{{ asset('frontend/main.85741bff.js')}}"></script>
    @yield('javascript')
</body>

</html>
