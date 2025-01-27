@extends('layouts.base_admin.base_dashboard')
@section('judul', 'List Pemesanan')
@section('script_head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pemesanan</h1>
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
                <h3 class="card-title">List Pemesanan</h3>
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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <table id="previewAkun" class="data-table table table-striped table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No </th>
                            <th>Nama Lengkap</th>
                            <th>Nomor Telepon</th>
                            <th>Status Pemesanan</th>
                            <th>Metode Pembayaran</th>
                            <th>Total Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemesanan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->no_telepon }}</td>
                                <td>
                                    @if ($item->status_pesanan == 'mengunggu pembayaran')
                                        <span class="text-warning">{{ $item->status_pesanan }}</span>
                                    @else
                                        <span class="text-success">{{ $item->status_pesanan }}</span>
                                    @endif
                                    <br>
                                    <br>
                                    <form action="{{ route('pemesanan.status', $item->id) }}" method="POST">
                                        @csrf
                                        <select name="status_pesanan" class="form-control" onchange="this.form.submit()">
                                            <option value="" selected disabled>Ubah Status</option>
                                            <option value="proses">Proses</option>
                                            <option value="mengunggu pembayaran">
                                                Mengunggu Pembayaran</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    @if ($item->metode_pembayaran == 'cod')
                                        <span class="text-danger">{{ $item->metode_pembayaran }}</span>
                                    @else
                                        <span class="text-primary">{{ $item->metode_pembayaran }}</span>
                                    @endif
                                </td>
                                <td>Rp. {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('pemesanan.show', $item->id) }}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
@endsection

@section('script_footer')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#previewAkun').DataTable({
                "pageLength": 5
            });
        });
    </script>
@endsection
