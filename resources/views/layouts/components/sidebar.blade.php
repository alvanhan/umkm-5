@php
    $links = [
        [
            'href' => route('home'),
            'text' => 'Dasboard',
            'icon' => 'fas fa-home',
            'is_multi' => false,
        ],
        [
            'text' => 'Kelola Produk',
            'icon' => 'fas fa-box',
            'is_multi' => true,
            'href' => [
                [
                    'section_text' => 'List Produk',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('produk.index'),
                ],
                [
                    'section_text' => 'List Kategori Produk',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('kategori.index'),
                ],
                [
                    'section_text' => 'List Daerah Khas Produk',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('daerah.index'),
                ]
            ],
        ],
        [
            'text' => 'Pesanan',
            'icon' => 'fas fa-shopping-cart',
            'is_multi' => true,
            'href' => [
                [
                    'section_text' => 'List Pesanan',
                    'section_icon' => 'far fa-circle',
                    'section_href' => route('pemesanan.index'),
                ]
            ],
        ],
    ];
    $navigation_links = json_decode(json_encode($links));
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <span class="brand-text font-weight-light">Selera Kampung</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @foreach ($navigation_links as $link)
                    @if (!$link->is_multi)
                        <li class="nav-item">
                            <a href="{{ url()->current() == $link->href ? '#' : $link->href }}"
                                class="nav-link {{ url()->current() == $link->href ? 'active' : '' }}">
                                <i class="nav-icon {{ $link->icon }}"></i>
                                <p>
                                    {{ $link->text }}
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                    @else
                        @php
                            foreach ($link->href as $section) {
                                if (url()->current() == $section->section_href) {
                                    $open = 'menu-open';
                                    $status = 'active';
                                    break; // Put this here
                                } else {
                                    $open = '';
                                    $status = '';
                                }
                            }
                        @endphp
                        <li class="nav-item {{ $open }}">
                            <a href="#" class="nav-link {{ $status }}">
                                <i class="nav-icon {{ $link->icon }}"></i>
                                <p>
                                    {{ $link->text }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($link->href as $section)
                                    <li class="nav-item">
                                        <a href="{{ url()->current() == $section->section_href ? '#' : $section->section_href }}"
                                            class="nav-link {{ url()->current() == $section->section_href ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ $section->section_text }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
