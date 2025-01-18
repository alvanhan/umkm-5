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
            <div>
                <h4 class="reveal-content">Konfirmasi Pesanan Anda</h4>
                <hr>
                <div id="list-pesanan-konfirm"></div>
            </div>
            <hr>
            <form class="reveal-content" id="checkout-form">
                <h4 class="reveal-content">Informasi Pengiriman</h4>
                <div id="list-pesanan-konfirm"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" required class="form-control" id="nama_lengkap"
                                placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <label for="no_telepon">No Telepon</label>
                            <input type="number" required min="1" class="form-control" id="no_telepon"
                                placeholder="08112223344">
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
                        <button type="submit" id="send-bayar" class="btn btn-primary" style="border-radius: 0;">Pesan
                            Sekarang</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('frontend/main.85741bff.js') }}"></script>
    <script>
        $('#send-bayar').click(function(e) {
            e.preventDefault();
            let pesanan = JSON.parse(localStorage.getItem('pesanan'));
            let pesananData = pesanan.map(item => ({
                id: parseInt(item.id),
                jumlah: parseInt(item.jumlah)
            }));
            $.ajax({
                url: '{{ route('index.prosesPesanan') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    pesanan: pesananData,
                    nama_lengkap: $('#nama_lengkap').val(),
                    no_telepon: $('#no_telepon').val(),
                    metode_pembayaran: $('#metode_pembayaran').val(),
                    alamat_lengkap: $('textarea[name="alamat_lengkap"]').val()
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pemesanan Berhasil',
                        text: 'Pemesanan Anda telah berhasil diproses!',
                    }).then(() => {
                        localStorage.removeItem('pesanan');
                        window.location.href = response.data;
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat memproses pesanan Anda!',
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            if (!localStorage.getItem('pesanan')) {
                $('#checkout-form').hide();
                $('#main-collapse').append(
                    '<h4 style="color: grey; margin:10%;">Silakan melakukan pesanan terlebih dahulu..</h4>');
            } else {
                let pesanan = JSON.parse(localStorage.getItem('pesanan'));
                let ids = pesanan.map(item => parseInt(item.id));
                $.ajax({
                    url: '{{ route('index.getProdukCheck') }}',
                    type: 'GET',
                    data: {
                        id: ids
                    },
                    success: function(response) {
                        let productHtml = '<div class="row">';
                        let totalHarga = 0;
                        response.forEach(function(item) {
                            let jumlah = pesanan.find(p => p.id == item.id).jumlah;
                            let hargaTotal = item.harga * jumlah;
                            totalHarga += hargaTotal;
                            productHtml += `
                                <div class="col-md-3">
                                    <div class="product-item">
                                        <div class="product-description">
                                            <h4 class="product-name">${item.nama}</h4>
                                            <p class="product-price">Rp${item.harga}</p>
                                            <p class="product-quantity">Jumlah: ${jumlah}</p>
                                            <p class="product-total">Total: Rp${hargaTotal}</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        productHtml += '</div>';
                        productHtml +=
                            `<div class="row"><div class="col-md-12"><h4>Total Pembayaran: Rp${totalHarga}</h4></div></div>`;
                        $('#list-pesanan-konfirm').append(productHtml);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Maaf, page tidak dapat diakses!',
                        }).then(() => {
                            window.location.href = '{{ route('index.getProduk') }}';
                        });
                    }
                });
            }
        });
    </script>
    @yield('javascript')
</body>

</html>
