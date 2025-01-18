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
        #loader {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        #main-content {
            display: none;
        }
    </style>
</head>

<body>
    <div id="loader">
        <img src="{{ asset('frontend/assets/images/loader.gif') }}" alt="Loading...">
    </div>
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
                        <li class="nav-divider"></li>
                        <li>
                            <div class="search-box" style="width: 100%;">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Cari makanan disini..." style="width: 100%;border: none;">
                            </div>
                        </li>
                        <script>
                            document.addEventListener("DOMContentLoaded", function(event) {
                                $('#search').on('input', function() {
                                    var query = $(this).val();
                                    if (query.length >= 3) {
                                        $.ajax({
                                            url: "{{ route('index.getProduk') }}",
                                            method: "GET",
                                            data: {
                                                search: query
                                            },
                                            success: function(response) {
                                                $('#produk_list').html(response);
                                                masonryBuild();
                                            },
                                            error: function(xhr) {
                                                console.error("Error fetching search results:", xhr);
                                            }
                                        });
                                    }
                                });
                            });
                        </script>
                        <li class="nav-divider"></li>
                        <li>
                            <div class="mt-3" style="width: 100%;">
                                <select name="daerah" class="form-control" style="width: 100%;border: none;"
                                    onchange="sendQuery()">
                                    <option value="" selected disabled>Pilih Daerah</option>
                                    @foreach ($daerah as $ditem)
                                        <option value="{{ encrypt($ditem->id) }}">{{ $ditem->nama_daerah }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                        <li class="nav-divider"></li>
                        <li>
                            <div class="filter-box mt-3" style="width: 100%;">
                                <select name="kategori" class="form-control" style="width: 100%;border: none;"
                                    onchange="sendQuery()">
                                    <option value="" selected disabled>Kategori</option>
                                    @foreach ($kategori as $kitem)
                                        <option value="{{ encrypt($kitem->id) }}">{{ $kitem->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                        <li class="nav-divider"></li>
                        <a href="#" class="">Keranjang <span id="cart-count"
                                style="background-color: red; color: white; border-radius: 50%; padding: 2px 8px;">0</span></a>
                        <li><a href="#" class="">Lihat Status Pesanan</a></li>
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
            <div class="hero-full-wrapper">
                <div class="grid">
                    <div class="gutter-sizer"></div>
                    <div class="grid-sizer"></div>
                    <div id="produk_list"></div>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    masonryBuild();
                });

                function sendQuery() {
                    var daerah = $('select[name="daerah"]').val();
                    var kategori = $('select[name="kategori"]').val();
                    $.ajax({
                        url: "{{ route('index.getProduk') }}",
                        method: "GET",
                        data: {
                            daerah: daerah,
                            kategori: kategori
                        },
                        success: function(response) {
                            $('#produk_list').html(response);
                            masonryBuild();
                        },
                        error: function(xhr) {
                            console.error("Error fetching products:", xhr);
                        }
                    });
                }
            </script>
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
        document.addEventListener("DOMContentLoaded", function(event) {
            $.ajax({
                url: "{{ route('index.getProduk') }}",
                method: "GET",
                success: function(response) {
                    $('#produk_list').html(response);
                    $('#loader').hide();
                    $('#main-content').show();
                    masonryBuild();
                },
                error: function(xhr) {
                    console.error("Error fetching products:", xhr);
                    $('#loader').hide();
                    $('#main-content').show();
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            $(document).on('click', '#btn-pesan', function() {
                var itemId = $(this).attr('name');
                var availableStock = parseInt($(this).closest('.project-text-inner').find('#tersedia').text().split(': ')[1]);
                Swal.fire({
                    title: 'Masukkan jumlah pesanan',
                    input: 'number',
                    inputAttributes: {
                        min: 1,
                        step: 1
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Pesan',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'swal2-popup',
                        confirmButton: 'swal2-confirm'
                    },
                    preConfirm: (jumlah) => {
                        if (!jumlah) {
                            Swal.showValidationMessage('Jumlah pesanan tidak boleh kosong');
                        } else if (jumlah > availableStock) {
                            Swal.showValidationMessage('Pesanan melebihi batas tersedia');
                        }
                        return jumlah;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var order = {
                            id: itemId,
                            jumlah: result.value
                        };

                        let currentOrders = [];
                        try {
                            let storedOrders = localStorage.getItem('pesanan');
                            if (storedOrders) {
                                currentOrders = JSON.parse(storedOrders);
                                if (!Array.isArray(currentOrders)) {
                                    currentOrders = [];
                                }
                            }
                        } catch (error) {
                            console.error("Error reading 'pesanan' from localStorage:", error);
                            currentOrders = [];
                        }
                        var existingOrder = currentOrders.find(order => order.id === itemId);
                        if (existingOrder) {
                            existingOrder.jumlah = (parseInt(existingOrder.jumlah) + parseInt(result.value)).toString();
                        } else {
                            currentOrders.push(order);
                        }
                        try {
                            localStorage.setItem('pesanan', JSON.stringify(currentOrders));
                        } catch (error) {
                            console.error("Error saving 'pesanan' to localStorage:", error);
                        }

                        Swal.fire('Pesanan berhasil ditambahkan!', `Jumlah: ${result.value}`, 'success').then(() => {
                            updateCartCount();
                        });
                    }
                });
            });
        });

        const style = document.createElement('style');
        style.innerHTML = `
            .swal2-popup {
                font-size: 1.6rem !important;
            }
            .swal2-confirm {
                background-color: #ff312d !important;
            }
        `;
        document.head.appendChild(style);
    </script>

    <script>
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
    </script>



    @yield('javascript')
</body>

</html>
