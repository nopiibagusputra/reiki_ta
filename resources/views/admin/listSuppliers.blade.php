@extends('layouts.app')

@section('title', 'Data Suppliers')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Suppliers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Suppliers</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if(session('info') || session('error'))
                        <div
                            class="alert alert-{{ session('info') ? 'success' : 'danger' }} alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('info') ?? session('error') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Suppliers</h3>
                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                data-target="#tambahSupplier">
                                Tambah Suppliers
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">Kode</th>
                                        <th>Nama Supplier</th>
                                        <th>Alamat</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <td style="text-align: center">{{ $item->kode }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td style="text-align: center">
                                                <button type="button" class="btn btn-sm btn-info variant-button edit-supplier" data-toggle="modal" data-target="#editSupplierModal" data-id="{{ $item->id }}" data-kode="{{ $item->kode }}" data-nama="{{ $item->nama }}" data-alamat="{{ $item->alamat }}">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger variant-button delete-supplier"
                                                    data-id="{{ $item->id }}">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="tambahSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for adding new material -->
                <form method="POST" action="{{ route('store.suppliers') }}">
                    @csrf
                    {{-- <div class="form-group">
                        <label for="supplierKode">Kode</label>
                        <input type="text" class="form-control" id="supplierKode" name="supplierKode"
                            placeholder="Contoh : PTA" required>
                    </div> --}}
                    <div class="form-group">
                        <label for="supplierName">Nama Supplier</label>
                        <input type="text" class="form-control" id="supplierName" name="supplierName"
                            placeholder="Masukkan Nama Supplier" required>
                    </div>
                    <div class="form-group">
                        <label for="supplierAlamat">Alamat</label>
                        <input type="text" class="form-control" id="supplierAlamat" name="supplierAlamat"
                            placeholder="Masukkan Alamat Supplier" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editSupplierModal" tabindex="-1" role="dialog" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for editing existing supplier -->
                <form id="editSupplierForm" method="POST" action="{{ route('update.suppliers') }}">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="supplier_id" id="supplier_id">
                    {{-- <div class="form-group">
                        <label for="edit_supplierKode">Kode</label>
                        <input type="text" class="form-control" id="edit_supplierKode" name="supplierKode" required>
                    </div> --}}
                    <div class="form-group">
                        <label for="edit_supplierName">Nama Supplier</label>
                        <input type="text" class="form-control" id="edit_supplierName" name="supplierName" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_supplierAlamat">Alamat</label>
                        <input type="text" class="form-control" id="edit_supplierAlamat" name="supplierAlamat" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    </script>
    <script>
        $(document).on('click', '.delete-supplier', function () {
            var supplier_id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin ?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '{{ route("delete.suppliers") }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": supplier_id
                        },
                        success: function (data) {
                            Swal.fire(
                                'Berhasil!',
                                'Data supplier dihapus!.',
                                'success'
                            ).then((result) => {
                                location.reload();
                            });
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.edit-supplier', function () {
            var id = $(this).data('id');
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');
            var alamat = $(this).data('alamat');
    
            $('#supplier_id').val(id);
            $('#edit_supplierKode').val(kode);
            $('#edit_supplierName').val(nama);
            $('#edit_supplierAlamat').val(alamat);
        });
    
        $('#editSupplierForm').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'PUT',
                url: '{{ route("update.suppliers") }}',
                data: formData,
                success: function (response) {
                    $('#editSupplierModal').modal('hide');
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle errors
                    console.log(xhr)
                }
            });
        });
    </script>
@endpush
@endsection
