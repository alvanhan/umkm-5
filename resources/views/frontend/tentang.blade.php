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
        body {
            background-image: url('{{ asset('frontend/assets/images/bgm.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
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
                        <a href="{{ route('index.checkout') }}" class="">Keranjang <span id="cart-count"
                                style="background-color: red; color: white; border-radius: 50%; padding: 2px 8px;">0</span></a>
                        <script>
                            document.addEventListener("DOMContentLoaded", function(event) {
                                function updateCartCount() {
                                    let cartCount = 0;
                                    try {
                                        let storedOrders = localStorage.getItem('pesanan');
                                        if (storedOrders) {
                                            let orders = JSON.parse(storedOrders);
                                            if (Array.isArray(orders)) {
                                                cartCount = orders.length;
                                            }
                                        }
                                    } catch (error) {
                                        console.error("Error reading 'pesanan' from localStorage:", error);
                                    }
                                    $('#cart-count').text(cartCount);
                                }

                                updateCartCount();
                                $(document).on('click', '#btn-pesan', function() {
                                    updateCartCount();
                                });
                            });
                        </script>
                        <li><a href="{{ route('index.tentangKami') }}" class="">Tentang Kami</a></li>
                    </ul>
                    <nav class="nav-footer">
                        <p>© Untitled | Selera Kampung</p>
                    </nav>
                </div>
            </nav>
        </header>
        <main class="" id="main-collapse">
            <div class="container">
                <p class="fs-6 text-center" style="color: rgb(0, 0, 0); font-size: 20px; margin-top: 20%; background-color: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 10px;">
                    **Selera Kampung** <br>
                    "Rasa Nostalgia, Hangatnya Kampung Halaman"
                    Selera Kampung adalah rumah makan khas Indonesia yang menghadirkan cita rasa autentik masakan
                    nusantara
                    langsung ke meja Anda. Mengusung konsep tradisional yang dipadukan dengan suasana hangat ala kampung
                    halaman, kami ingin setiap pelanggan merasakan kelezatan makanan khas Indonesia yang kaya akan
                    rempah.
                    Dengan dekorasi bernuansa kayu, anyaman bambu, dan sentuhan ornamen budaya lokal, suasana di Selera
                    Kampung terasa seperti pulang ke rumah nenek di desa. Kami menyajikan hidangan legendaris seperti
                    rendang, ayam goreng kremes, soto, nasi liwet, dan sambal khas yang selalu segar.
                    Kami juga menyediakan aneka minuman tradisional seperti es cendol, wedang jahe, dan teh hangat dari
                    daun
                    teh pilihan. Dengan harga yang terjangkau, Selera Kampung menjadi tempat yang sempurna untuk
                    berkumpul
                    bersama keluarga, teman, atau kolega. <br>
                    Mari kunjungi Selera Kampung dan nikmati kelezatan yang membangkitkan kenangan manis di hati! 🌾
                </p>
            </div>
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
    @yield('javascript')
</body>

</html>
