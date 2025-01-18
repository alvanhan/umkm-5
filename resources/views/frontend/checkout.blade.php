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
</head>

<body>
    <div id="main-content">
        <header class="">
            <div class="navbar navbar-default visible-xs">
                <button type="button" class="navbar-toggle collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ route('menu.index') }}" class="navbar-brand">Selera Kampung</a>
            </div>

            <nav class="sidebar navbar-fixed-top">
                <div class="navbar-collapse" id="navbar-collapse">
                    <div class="site-header hidden-xs">
                        <a class="site-brand" href="{{ route('menu.index') }}" title="">
                            <img class="img-responsive site-logo" alt=""
                                src="{{ asset('frontend/assets/images/mashup-logo.svg') }}">
                            Selera Kampung
                        </a>
                        <p>Temukan berbagai macam makanan khas Indonesia</p>
                    </div>
                    <ul class="nav">
                        <li><a href="{{ route('menu.index') }}" class="">Pilihan Menu</a></li>
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
            <form action="" class="reveal-content" id="checkout-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <label for="metode_pembayaran">Email</label>
                            <input type="text" class="form-control" id="no_telepon" placeholder="No Telepon">
                        </div>
                        <div class="form-group">
                            <label for="metode_pembayaran">Metode Pembayaran</label>
                            <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                                <option value="transfer_bank">Transfer Bank / Virtual Account</option>
                                <option value="cod">Cash on Delivery (COD)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat_lengkap">Alamat Lengkap</label>
                            <textarea class="form-control" rows="3" name="alamat_lengkap" placeholder="Alamat Lengkap dengan benar.."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="border-radius: 0;">Pembayaran</button>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled address-container">
                            <li>
                                <span class="fa-icon">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                                +62 812 3456 7890
                            </li>
                            <li>
                                <span class="fa-icon">
                                    <i class="fa fa-at" aria-hidden="true"></i>
                                </span>
                                selera-kampung@mail.com
                            </li>
                            <li>
                                <span class="fa-icon">
                                    <i class="fa fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                                Jl. Raya No.126, Jawa Barat
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </main>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            navbarToggleSidebar();
            navActivePage();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend/main.85741bff.js') }}"></script>
    <script>
        $(document).ready(function() {
            if (!localStorage.getItem('pesanan')) {
                $('#checkout-form').hide();
                $('#main-collapse').append('<h4 style="color: grey; margin:10%;">Silakan melakukan pesanan terlebih dahulu..</h4>');
            }
        });
    </script>
    @yield('javascript')
</body>

</html>
