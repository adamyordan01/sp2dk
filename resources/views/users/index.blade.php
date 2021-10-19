@extends('layouts.base', ['title' => 'MoSART - Pengguna'])

@push('style')
    {{-- <link rel="stylesheet" href="https://nightly.datatables.net/css/dataTables.bootstrap5.min.css"> --}}

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endpush

@section('section-header')
    <h1>Daftar Pengguna</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Daftar Pengguna
                    <div class="col-md">
                        <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah Pengguna
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Seksi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js   "></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script>
        $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
        });

        $(document).ready(function() {
            $('.data-table').DataTable({
                dom: 'lBfrtip',
                buttons: ['copy', 'excel', 'pdf', 'csv', 'print'],
                processing: true,
                serverside: true,
                ajax: "{{ route('user.get-users') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'name', name:'name'},
                    {data: 'nip', name:'nip'},
                    {data: 'position.nama_jabatan', name:'position.nama_jabatan'},
                    {data: 'section.nama_seksi', name:'section.nama_seksi'},
                    {data: 'action', name:'action', 'orderable': false, 'searchable': false, 'exportable': false, 'printable': false},
                ]
            })
        })

        $(document).on('click', '#deleteButton', function() {
            var user_id = $(this).data('id');
            var url = '{{ route('user.destroy') }}';

            swal.fire({
                title: 'Apakah anda yakin',
                html: 'Kamu akan menghapus pengguna ini?',
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonText: 'Ya hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    $.post(url, {user_id:user_id}, function(data) {
                        if (data.code == 1) {
                            $('.data-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.message)
                        } else {
                            toastr.error(data.message)
                        }
                    }, 'json');
                }
            })
        })
    </script>
@endpush
