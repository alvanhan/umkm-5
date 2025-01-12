@extends('layouts.base_admin.base_dashboard')
@section('judul', 'List Produk ')
@section('script_head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Produk</h1>
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
                <h3 class="card-title">List Produk</h3>
                <div class="card-tools">
                    <a href="{{ route('produk.create') }}" class="btn btn-sm btn-success">+ Add Produk</a>
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
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckChecked{{ $item->id }}"
                                            {{ $item->status == 1 ? 'checked' : '' }}
                                            onclick="updateStatus({{ $item->id }}, this.checked ? 1 : 0)">
                                        <label class="form-check-label"
                                            for="flexSwitchCheckChecked{{ $item->id }}">{{ $item->status == 1 ? 'Aktif' : 'Non Aktif' }}</label>
                                    </div>
                                    <script>
                                        function updateStatus(id, status) {
                                            window.location.href = `{{ url('dashboard/produk/status') }}/${id}/${status}`;
                                        }
                                    </script>
                                </td>
                                <td>
                                    <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('produk.destroy', $item->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
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
