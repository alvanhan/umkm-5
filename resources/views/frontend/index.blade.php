<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta content="Makanan Khas Indonesia" name="Makanan Khas Indonesia">
    <meta name="google" content="notranslate" />
    <meta content="Selera Kampung" name="author">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{ asset('frontend/assets/apple-icon-180x180.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <title>Selera Kampung</title>
    <link href="{{ asset('frontend/main.82cfd66e.css') }}" rel="stylesheet">
    <style>
    </style>
</head>

<body>
    <header class="">
        <div class="navbar navbar-default visible-xs">
            <button type="button" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ route('index') }}" class="navbar-brand">Selera Kampung</a>
        </div>

        <nav class="sidebar navbar-fixed-top">
            <div class="navbar-collapse" id="navbar-collapse">
                <div class="site-header hidden-xs">
                    <a class="site-brand" href="{{ route('index') }}" title="">
                        <img class="img-responsive site-logo" alt=""
                            src="{{ asset('frontend/assets/images/mashup-logo.svg') }}">
                        Selera Kampung
                    </a>
                    <p>Temukan berbagai macam makanan khas Indonesia</p>
                </div>
                <ul class="nav">
                    <li><a href="{{ route('menu.index') }}" class="">Pilihan Menu</a></li>
                    <li class="nav-divider"></li>
                    <li>
                        <div class="search-box" style="width: 100%;">
                            <form action="" method="GET" class="input-group">
                                <input type="text" name="query" class="form-control"
                                    placeholder="Cari makanan disini..." style="width: 100%; outline: none; border: none;">
                            </form>
                        </div>
                    </li>

                    <li class="nav-divider"></li>
                    <li>
                        <div class="filter-box mt-3" style="width: 100%;">
                            <form action="" method="GET" class="input-group">
                                <select name="category" class="form-control" style="width: 100%; outline: none; border: none;">
                                    <option value="" selected disabled>Pilih Daerah</option>
                                    <option value="aceh">Aceh</option>
                                    <option value="bali">Bali</option>
                                    <option value="bandung">Bandung</option>
                                    <option value="batak">Batak</option>
                                    <option value="betawi">Betawi</option>
                                    <option value="jawa">Jawa</option>
                                    <option value="padang">Padang</option>
                                </select>
                            </form>
                        </div>
                    </li>
                    <li class="nav-divider"></li>
                    <li><a href="#" class="">Tentang Kami</a></li>
                    <li><a href="#" class="">Kontak Kami</a></li>

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
    <script type="text/javascript" src="{{ asset('frontend/main.85741bff.js') }}"></script>
    @yield('javascript')
</body>

</html>
