@extends('layouts.base_admin.base_dashboard')@section('judul', 'List ')
@section('script_head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0" style="margin: 20px">

            </div>
            <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $produk->nama_produk }}" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ $produk->harga }}" required>
                </div>
                <div class="form-group">
                    <label for="khas_wilayah">Khas Wilayah</label>
                    <select class="form-control" id="khas_wilayah" name="khas_wilayah" required>
                        <option value="">Pilih Wilayah</option>
                        @foreach($wilayah as $w)
                            <option value="{{ $w->id }}" {{ $produk->khas_wilayah == $w->id ? 'selected' : '' }}>{{ $w->nama_wilayah }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kategori_produk">Kategori Produk</label>
                    <select class="form-control" id="kategori_produk" name="kategori_produk" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}" {{ $produk->kategori_produk == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="deskripsi_produk">Deskripsi Produk</label>
                    <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" required>{{ $produk->deskripsi_produk }}</textarea>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $produk->quantity }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    @endsection @section('script_footer')
    <script></script>
@endsection
